<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

/**
 * SEO content fixes for the live site (php artisan db:seed --class=SeoContentSeeder --force).
 *
 * Every change is guarded: a value is only replaced while it still holds the old, empty or
 * placeholder text, so anything already edited in the dashboard is kept. Running it again
 * changes nothing. A table at the end lists what was updated and what was kept.
 */
class SeoContentSeeder extends Seeder
{
    /** One brand name everywhere (titles, schema, Google Business Profile). */
    private const SITE_NAME = ['ar' => 'حلول HULUL', 'en' => 'HULUL'];

    /** Shown on the site until now, hard-coded; it becomes the dashboard field "email_ksa". */
    private const EMAIL_KSA = 'info@hololnet.com';

    /**
     * Meta for the listing pages. Titles carry no brand: the site adds " | {site name}" itself.
     * Pages without 'key' keep their current keywords.
     */
    private const PAGE_META = [
        'services' => [
            'ar' => [
                'title' => 'خدمات التسويق الرقمي والتصميم وتطوير المواقع',
                'description' => 'تعرّف على خدمات حلول: التسويق الإلكتروني وإدارة السوشيال ميديا، تصميم الهوية البصرية، تطوير المواقع والتطبيقات، وإنتاج المحتوى في مصر والسعودية.',
                'key' => 'خدمات تسويق رقمي, شركة تسويق الكتروني, تصميم مواقع, تطوير تطبيقات, تصميم هوية بصرية, إدارة سوشيال ميديا, إنتاج محتوى, تغطية إعلامية, شركة تسويق في مصر, شركة تسويق في السعودية',
            ],
            'en' => [
                'title' => 'Digital Marketing, Design & Web Development Services',
                'description' => 'HULUL services: digital marketing, social media, brand identity, website and app development, content production and media coverage in Egypt and Saudi Arabia.',
                'key' => 'digital marketing services, marketing agency Egypt, marketing agency Saudi Arabia, web development, mobile app development, brand identity design, social media management, content production, media coverage',
            ],
        ],
        'portfolio' => [
            'ar' => [
                'title' => 'أعمالنا في التسويق والتصميم وتطوير المواقع',
                'description' => 'شاهد نماذج من أعمال حلول لعملائنا في مصر والسعودية: هويات بصرية، تصميمات سوشيال ميديا، مواقع وتطبيقات، حملات إعلانية وإنتاج فيديو.',
                'key' => 'أعمال حلول, نماذج تصميم, بورتفوليو شركة تسويق, تصميم هوية بصرية, تصميم مواقع, حملات إعلانية, إنتاج فيديو',
            ],
            'en' => [
                'title' => 'Our Work: Branding, Web & Marketing Projects',
                'description' => 'See HULUL\'s work for clients in Egypt and Saudi Arabia: brand identities, social media designs, websites and apps, ad campaigns and video production.',
                'key' => 'HULUL portfolio, marketing agency portfolio, brand identity projects, website design portfolio, ad campaigns, video production',
            ],
        ],
        'faq' => [
            'ar' => [
                'title' => 'الأسئلة الشائعة عن خدمات التسويق والتصميم',
                'description' => 'إجابات عن أكثر الأسئلة شيوعًا حول خدمات حلول: التسويق الرقمي، تصميم المواقع والتطبيقات، الهوية البصرية، المدة والتكلفة وطريقة العمل.',
                'key' => 'أسئلة شائعة, شركة تسويق, تكلفة تصميم موقع, مدة تصميم تطبيق, خدمات التسويق الرقمي',
            ],
            'en' => [
                'title' => 'FAQ - Digital Marketing, Design & Web Services',
                'description' => 'Answers to common questions about HULUL\'s services: digital marketing, website and app development, brand identity, timelines, pricing and how we work.',
                'key' => 'FAQ, marketing agency questions, website design cost, app development timeline, digital marketing services',
            ],
        ],
        // these three were copies of the home page meta: same title on four pages
        'about' => [
            'ar' => [
                'title' => 'من نحن - وكالة تسويق رقمي في مصر والسعودية',
                'description' => 'حلول وكالة تسويق رقمي وإنتاج إعلامي في القاهرة وجدة، بفريق متخصص في بناء العلامات التجارية، التسويق الإلكتروني، تطوير المواقع والتطبيقات، وإنتاج المحتوى.',
            ],
            'en' => [
                'title' => 'About Us - Digital Marketing Agency in Egypt & KSA',
                'description' => 'HULUL is a digital marketing and media production agency in Cairo and Jeddah, specialised in branding, digital marketing, web and app development, and content.',
            ],
        ],
        'blogs' => [
            'ar' => [
                'title' => 'مقالات التسويق الرقمي وتصميم المواقع',
                'description' => 'مقالات ونصائح عملية من فريق حلول عن التسويق الإلكتروني، السوشيال ميديا، تحسين محركات البحث SEO، وتصميم المواقع لمساعدة نشاطك على النمو.',
            ],
            'en' => [
                'title' => 'Digital Marketing & Web Design Blog',
                'description' => 'Practical articles and tips from the HULUL team on digital marketing, social media, SEO and website design to help your business grow.',
            ],
        ],
        'contact_us' => [
            'ar' => [
                'title' => 'تواصل معنا - مكاتب حلول في القاهرة وجدة',
                'description' => 'تواصل مع حلول لطلب استشارة أو عرض سعر: مكتبنا في الدقي بالقاهرة وفرعنا في جدة. اتصل بنا أو راسلنا على واتساب ويرد عليك فريقنا في أسرع وقت.',
            ],
            'en' => [
                'title' => 'Contact Us - Offices in Cairo & Jeddah',
                'description' => 'Contact HULUL for a consultation or a quote: our office in Dokki, Cairo and our branch in Jeddah. Call or message us on WhatsApp and we will get back to you.',
            ],
        ],
    ];

    /**
     * CMS pages left from the flower-shop and medical templates (Dalia El Haggar, lorem ipsum,
     * test pages), still reachable under /pages/{slug}. Switched off only if not edited since
     * (id => updated_at on the live database).
     */
    private const LEFTOVER_PAGES = [
        1 => '2025-06-22 12:14:42',  // about-us: "About Dalia El Haggar – Where Flowers Tell Stories"
        2 => '2025-05-11 07:21:43',  // terms-and-conditions: flower bouquets and delivery
        3 => '2025-05-08 07:55:23',  // privacy-policy: purchases from the flower shop
        4 => '2025-01-04 12:12:07',  // insurance: lorem ipsum
        5 => '2025-04-28 13:17:32',  // home: broken characters only
        11 => '2024-09-10 15:51:54', // "hhhh"
        12 => '2024-09-10 21:28:38', // "fdfdfdfd"
        16 => '2024-09-10 23:12:49', // "yuyuyuyuyu"
        17 => '2024-09-17 07:48:27', // "page description"
        18 => '2024-09-14 14:41:43', // "trtrtr page fron service 18"
        19 => '2024-09-17 07:45:46', // "landscape page description"
        22 => '2025-04-18 11:39:43', // second privacy-policy: orders from the flower shop
    ];

    private array $report = [];

    public function run()
    {
        DB::transaction(function () {
            $this->siteSettings();
            $this->pageMeta();
            $this->audioService();
            $this->statistics();
            $this->brandNameInBlogs();
            $this->leftoverPages();
        });

        // the home page data and the menus are cached forever
        foreach (['home_page_data_ar', 'home_page_data_en', 'menus', 'footer-menus'] as $key) {
            Cache::forget($key);
        }

        $this->command->table(['Result', 'What'], $this->report);
    }

    private function siteSettings(): void
    {
        $settingId = DB::table('settings')->where('key', 'site_setting')->value('id');
        if (! $settingId) {
            $this->note('skipped', 'site settings: no site_setting row');
            return;
        }

        foreach (self::SITE_NAME as $locale => $name) {
            $this->setSetting($settingId, 'site_name_' . $locale, $name, ['Hulul-eg', 'Holol']);
        }

        $this->setSetting($settingId, 'email', 'info@hululeg.com', ['INFO@HULULEG.COM']);
        $this->setSetting($settingId, 'email_ksa', self::EMAIL_KSA, []);
    }

    private function pageMeta(): void
    {
        $settingId = DB::table('settings')->where('key', 'meta_setting')->value('id');
        if (! $settingId) {
            $this->note('skipped', 'page meta: no meta_setting row');
            return;
        }

        $home = DB::table('settings_values')->where('setting_id', $settingId)
            ->where('key', 'like', 'home\_meta\_%')->pluck('value', 'key');

        foreach (self::PAGE_META as $page => $locales) {
            foreach ($locales as $locale => $fields) {
                foreach ($fields as $field => $value) {
                    // placeholders the template shipped with, and the home meta that was pasted in
                    $old = [
                        $page,
                        "{$page} Meta {$field} in Arabic",
                        "{$page} Meta {$field} in English",
                        $home["home_meta_{$field}_ar"] ?? null,
                        $home["home_meta_{$field}_en"] ?? null,
                    ];

                    $this->setSetting($settingId, "{$page}_meta_{$field}_{$locale}", $value, $old);
                }
            }
        }
    }

    /** "Audio content production": English text was a keyword list, titles ran past 70 characters. */
    private function audioService(): void
    {
        $where = fn ($locale) => ['service_cat_id' => 26, 'locale' => $locale];

        $this->setIfUnchanged('service_category_translations', $where('ar'), 'meta_title',
            'إنتاج محتوى مسموع: بودكاست وإعلانات إذاعية',
            ['قسم إنتاج محتوى مسموع احترافي في مصر والسعودية | بودكاست وإعلانات إذاعية | حلول'],
            'audio service (ar): meta title');

        $this->setIfUnchanged('service_category_translations', $where('en'), 'meta_title',
            'Audio Content Production: Podcasts & Radio Ads',
            ['Audio Production & Sound Branding Company in Egypt & Saudi Arabia | Hulul'],
            'audio service (en): meta title');

        $this->setIfUnchanged('service_category_translations', $where('en'), 'description',
            '<p>We help brands build a professional audio presence through audio content production, including radio and audio ads, voice-overs, podcasts and marketing messages. We take care of the script, the tone of voice and the final recording, so your message comes through clearly and stays with your audience.</p>',
            ['<p>audio content production, voice over services, audio ads, podcast production, audio branding, recording services, branded audio, sound production</p>'],
            'audio service (en): page text');
    }

    /** Home statistics wording ("علامات تجارنا", "Perspective Clients"); the numbers are left alone. */
    private function statistics(): void
    {
        $this->replaceText('statistic_translations', ['title', 'description', 'slug'], [
            'تجارنا' => 'تجارية',
            'Perspective' => 'Prospective',
            'perspective' => 'prospective',
        ], 'statistics');
    }

    /** "Holol" in the English articles is the old spelling of the brand. */
    private function brandNameInBlogs(): void
    {
        $this->replaceText('blog_translations', ['title', 'description', 'meta_title', 'meta_desc'], [
            'Holol' => 'HULUL',
        ], 'articles');
    }

    private function leftoverPages(): void
    {
        foreach (self::LEFTOVER_PAGES as $id => $updatedAt) {
            $page = DB::table('pages')->where('id', $id)->whereNull('deleted_at')->first();

            if (! $page || ! $page->status) {
                $this->note('already done', "page #{$id}: off");
            } elseif ((string) $page->updated_at !== $updatedAt) {
                $this->note('kept', "page #{$id}: edited since, left on");
            } else {
                DB::table('pages')->where('id', $id)->update(['status' => 0]);
                $this->note('updated', "page #{$id}: switched off (old template content)");
            }
        }
    }

    // helpers -----------------------------------------------------------------------------

    private function setSetting(int $settingId, string $key, string $value, array $old): void
    {
        $where = ['setting_id' => $settingId, 'key' => $key];

        if (! DB::table('settings_values')->where($where)->exists()) {
            DB::table('settings_values')->insert($where + ['value' => $value, 'type' => 0, 'created_at' => now(), 'updated_at' => now()]);
            $this->note('updated', "setting {$key}: added");
            return;
        }

        $this->setIfUnchanged('settings_values', $where, 'value', $value, $old, "setting {$key}");
    }

    /** Writes $new when the column is empty or still holds one of the $old values. */
    private function setIfUnchanged(string $table, array $where, string $column, string $new, array $old, string $label): void
    {
        $row = DB::table($table)->where($where)->first();

        if (! $row) {
            $this->note('skipped', "{$label}: row not found");
        } elseif ($this->plain($row->{$column}) === $this->plain($new)) {
            $this->note('already done', $label);
        } elseif ($this->plain($row->{$column}) === '' || in_array($this->plain($row->{$column}), array_map([$this, 'plain'], $old), true)) {
            DB::table($table)->where($where)->update([$column => $new]);
            $this->note('updated', $label);
        } else {
            $this->note('kept', "{$label}: edited in the dashboard");
        }
    }

    private function replaceText(string $table, array $columns, array $replacements, string $label): void
    {
        $rows = DB::table($table)->get(array_merge(['id'], $columns));
        $changed = 0;

        foreach ($rows as $row) {
            $update = [];
            foreach ($columns as $column) {
                if ($row->{$column} !== null) {
                    $text = strtr($row->{$column}, $replacements);
                    if ($text !== $row->{$column}) {
                        $update[$column] = $text;
                    }
                }
            }

            if ($update) {
                DB::table($table)->where('id', $row->id)->update($update);
                $changed++;
            }
        }

        $this->note($changed ? 'updated' : 'already done', "{$label}: " . implode(', ', array_keys($replacements)) . " ({$changed} rows)");
    }

    /** Text as a visitor reads it, so editor markup and spacing don't count as an edit. */
    private function plain(?string $value): string
    {
        $text = html_entity_decode(strip_tags((string) $value), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $text) ?? $text);
    }

    private function note(string $result, string $what): void
    {
        $this->report[] = [$result, $what];
    }
}
