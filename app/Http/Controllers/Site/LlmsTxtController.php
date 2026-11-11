<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\Blog;
use App\Support\WhatsApp;
use App\Support\SocialLinks;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * /llms.txt (llmstxt.org): a plain Markdown guide to the site for AI assistants and answer
 * engines. Built from the same data as the pages, so it follows every edit in the dashboard.
 */
class LlmsTxtController extends Controller
{
    public function index()
    {
        $lines = [];
        $name = $this->setting('site_name_ar') ?: $this->setting('site_name_en') ?: config('app.name');

        $lines[] = '# ' . $name;
        $lines[] = '';
        foreach (['about_meta_description_en', 'about_meta_description_ar'] as $key) {
            if ($summary = $this->plain($this->setting($key))) {
                $lines[] = '> ' . $summary;
                $lines[] = '>';
            }
        }
        if (end($lines) === '>') {
            array_pop($lines);
        }
        $lines[] = '';

        $lines[] = '- Names: ' . implode(', ', array_unique(array_filter([$name, $this->setting('site_name_en'), 'HULUL', 'حلول'])));
        $lines[] = '- Languages: Arabic (main, ' . url('ar') . ') and English (' . url('en') . ')';
        if ($address = $this->plain($this->setting('address_en'))) {
            $lines[] = '- Egypt office: ' . $address . ' — ' . $this->plain($this->setting('address_ar'));
        }
        if ($address = $this->plain($this->setting('address_ksa_en'))) {
            $lines[] = '- Saudi Arabia office: ' . $address . ' — ' . $this->plain($this->setting('address_ksa_ar'));
        }
        $phones = array_filter([
            WhatsApp::tel($this->setting('mobile'), WhatsApp::EGYPT) ? 'Egypt ' . WhatsApp::tel($this->setting('mobile'), WhatsApp::EGYPT) : null,
            WhatsApp::tel($this->setting('mobile_ksa'), WhatsApp::SAUDI_ARABIA) ? 'Saudi Arabia ' . WhatsApp::tel($this->setting('mobile_ksa'), WhatsApp::SAUDI_ARABIA) : null,
        ]);
        if ($phones) {
            $lines[] = '- Phone: ' . implode(', ', $phones);
        }
        if ($email = $this->setting('email')) {
            $lines[] = '- Email: ' . strtolower($email);
        }
        if ($profiles = SocialLinks::profiles()) {
            $lines[] = '- Official profiles: ' . implode(', ', $profiles);
        }
        $lines[] = '';

        $categories = ServiceCategory::withoutGlobalScope('transNow')->active()->with('translations')->orderBy('sort', 'ASC')->get();
        $blogs = Blog::active()->with('translations')->orderBy('sort', 'ASC')->get();

        foreach (['en' => ['Services', 'Articles', 'Company'], 'ar' => ['الخدمات', 'المقالات', 'عن الشركة']] as $locale => $headings) {
            $lines[] = '## ' . $headings[0];
            $lines[] = '';
            foreach ($categories as $category) {
                $trans = $category->translations->firstWhere('locale', $locale);
                if ($trans && $trans->slug && $trans->title) {
                    $lines[] = $this->item($trans->title, url($locale . '/services/' . rawurlencode($trans->slug)), $trans->meta_desc ?: $trans->description);
                }
            }
            $lines[] = '';

            $lines[] = '## ' . $headings[1];
            $lines[] = '';
            foreach ($blogs as $blog) {
                $trans = $blog->translations->firstWhere('locale', $locale);
                if ($trans && $trans->title) {
                    $lines[] = $this->item($trans->title, $blog->url($locale), $trans->meta_desc);
                }
            }
            $lines[] = '';

            $lines[] = '## ' . $headings[2];
            $lines[] = '';
            foreach ($this->companyPages($locale) as $path => $page) {
                $lines[] = $this->item($page[0], url($locale . '/' . $path), $page[1] ? $this->setting($page[1]) : null);
            }
            $lines[] = '';
        }

        $lines[] = '## Optional';
        $lines[] = '';
        $lines[] = '- [Sitemap](' . url('sitemap.xml') . '): every page in Arabic and English';

        return response(implode("\n", $lines) . "\n")
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    /** path => [link text, settings key of its meta description] */
    private function companyPages(string $locale): array
    {
        $ar = $locale === 'ar';
        $pages = [
            'about-us' => [$ar ? 'من نحن' : 'About us', 'about_meta_description_' . $locale],
            'portfolio' => [$ar ? 'أعمالنا' : 'Our work', 'portfolio_meta_description_' . $locale],
            'faq-questions' => [$ar ? 'الأسئلة الشائعة' : 'FAQ', 'faq_meta_description_' . $locale],
            'contact-us' => [$ar ? 'اتصل بنا' : 'Contact us', 'contact_us_meta_description_' . $locale],
            'service_request' => [$ar ? 'طلب خدمة أو عرض سعر' : 'Request a service or a quote', null],
        ];

        if (! Faq::active()->exists()) {
            unset($pages['faq-questions']);
        }

        return $pages;
    }

    private function item(string $title, string $url, ?string $description): string
    {
        $description = \Illuminate\Support\Str::limit($this->plain($description), 200);

        return '- [' . $this->plain($title) . '](' . $url . ')' . ($description !== '' ? ': ' . $description : '');
    }

    private function setting(string $key): string
    {
        static $values;
        $values ??= DB::table('settings_values')->pluck('value', 'key');

        $value = trim((string) ($values[$key] ?? ''));

        return $value === 'NULL' ? '' : $value;
    }

    /** One line of plain text from dashboard HTML. */
    private function plain(?string $value): string
    {
        $text = html_entity_decode(strip_tags(str_replace('<', ' <', (string) $value)), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $text) ?? $text);
    }
}
