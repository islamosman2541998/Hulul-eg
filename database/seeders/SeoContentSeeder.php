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
            $this->digitalMarketingService();
            $this->blogSlugs();
            $this->faqs();
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

    /**
     * "Digital marketing services" carried the /services page's title and a description of every
     * service, so the two pages competed for the same searches.
     */
    private function digitalMarketingService(): void
    {
        $where = fn ($locale) => ['service_cat_id' => 21, 'locale' => $locale];

        $this->setIfUnchanged('service_category_translations', $where('ar'), 'meta_title',
            'شركة تسويق إلكتروني وإعلانات ممولة وSEO',
            ['خدمات التسويق الرقمي والتصميم وتطوير المواقع | حلول'],
            'digital marketing service (ar): meta title');

        $this->setIfUnchanged('service_category_translations', $where('en'), 'meta_title',
            'Digital Marketing: Social Media, Paid Ads & SEO',
            ['Digital Marketing, Design & Web Development Services | Hulul'],
            'digital marketing service (en): meta title');

        $this->setIfUnchanged('service_category_translations', $where('ar'), 'meta_desc',
            '<p>خدمات تسويق إلكتروني من حلول في مصر والسعودية: إدارة السوشيال ميديا، الحملات الإعلانية الممولة، تحسين محركات البحث SEO، التسويق بالمحتوى والخطط التسويقية.</p>',
            ['<p>اكتشف خدمات حلول في التسويق الرقمي، إدارة الحملات الإعلانية، التصميم، تطوير المواقع والتطبيقات، التغطية الإعلامية، إنتاج المحتوى، والطباعة لمساعدة علامتك التجارية على النمو.</p>'],
            'digital marketing service (ar): meta description');

        $this->setIfUnchanged('service_category_translations', $where('en'), 'meta_desc',
            '<p>HULUL digital marketing in Egypt and Saudi Arabia: social media management, paid ad campaigns, SEO, content marketing and marketing plans.</p>',
            ['<p>Explore Hulul&rsquo;s digital marketing, advertising, graphic design, website development, mobile app development, media coverage, content production, printing, and branding solutions.</p>'],
            'digital marketing service (en): meta description');
    }

    /**
     * Articles now live at /blogs/{slug}. A few slugs start or end with "-" (copied titles with a
     * trailing space); they become the address, so they are tidied once before anyone links them.
     */
    private function blogSlugs(): void
    {
        $changed = 0;

        foreach (DB::table('blog_translations')->get(['id', 'locale', 'slug']) as $row) {
            $slug = trim((string) $row->slug, "- \t\n");

            if ($slug === '' || $slug === $row->slug) {
                continue;
            }

            $taken = DB::table('blog_translations')->where('slug', $slug)->where('id', '!=', $row->id)->exists();
            if ($taken) {
                $this->note('kept', "article slug #{$row->id}: \"{$slug}\" already used");
                continue;
            }

            DB::table('blog_translations')->where('id', $row->id)->update(['slug' => $slug]);
            $changed++;
        }

        $this->note($changed ? 'updated' : 'already done', "article slugs: leading/trailing dashes ({$changed} rows)");
    }

    /**
     * The FAQ page showed the medical template's questions (Selenium ACE and Omega supplements,
     * categories "Science", "Safety", "Events"). They are soft-deleted, so they can be restored
     * from the database, and replaced with questions answered from what the site already states.
     */
    private function faqs(): void
    {
        $templateFaqs = DB::table('faq_translations')
            ->where(fn ($q) => $q->where('question', 'like', '%Selenium%')->orWhere('answer', 'like', '%سيلينيوم%')->orWhere('answer', 'like', '%Selenium%'))
            ->pluck('faq_id')->unique();
        $removed = DB::table('faqs')->whereIn('id', $templateFaqs)->whereNull('deleted_at')->update(['deleted_at' => now(), 'status' => 0]);
        $this->note($removed ? 'updated' : 'already done', "FAQ: template questions removed ({$removed})");

        $templateCategories = DB::table('faq_category_translations')
            ->whereIn('title', ['علوم', 'معلوم', 'الامان', 'المناسبات', 'Science', 'Sciencee', 'Safety', 'Events'])
            ->pluck('faq_category_id')->unique();
        $removed = DB::table('faq_categories')->whereIn('id', $templateCategories)->whereNull('deleted_at')->update(['deleted_at' => now(), 'status' => 0]);
        $this->note($removed ? 'updated' : 'already done', "FAQ: template categories removed ({$removed})");

        $content = $this->faqContent();
        $firstQuestion = $content[0]['questions'][0]['ar'][0];

        if (DB::table('faq_translations')->where('question', $firstQuestion)->exists()) {
            $this->note('already done', 'FAQ: HULUL questions');
            return;
        }
        if (DB::table('faqs')->whereNull('deleted_at')->where('status', 1)->exists()) {
            $this->note('kept', 'FAQ: questions written in the dashboard, none added');
            return;
        }

        $sort = 0;
        foreach ($content as $categorySort => $category) {
            $categoryId = DB::table('faq_categories')->insertGetId([
                'sort' => $categorySort + 1, 'status' => 1, 'created_at' => now(), 'updated_at' => now(),
            ]);
            foreach (['ar', 'en'] as $locale) {
                DB::table('faq_category_translations')->insert([
                    'faq_category_id' => $categoryId, 'locale' => $locale, 'title' => $category['title'][$locale],
                ]);
            }

            foreach ($category['questions'] as $question) {
                $faqId = DB::table('faqs')->insertGetId([
                    'faq_category_id' => $categoryId, 'sort' => ++$sort, 'status' => 1, 'created_at' => now(), 'updated_at' => now(),
                ]);
                foreach (['ar', 'en'] as $locale) {
                    DB::table('faq_translations')->insert([
                        'faq_id' => $faqId, 'locale' => $locale,
                        'question' => $question[$locale][0], 'answer' => '<p>' . $question[$locale][1] . '</p>',
                    ]);
                }
            }
        }

        $this->note('updated', "FAQ: {$sort} HULUL questions in " . count($content) . ' categories added');
    }

    /**
     * Every answer comes from what the site already says (services, sub-services, page meta,
     * addresses in the dashboard), with links to the page that covers it. No prices or timelines:
     * the team adds those in the dashboard once they are settled.
     */
    private function faqContent(): array
    {
        $setting = fn ($key) => trim((string) DB::table('settings_values')->where('key', $key)->value('value'));

        $services = DB::table('service_categories as c')
            ->join('service_category_translations as t', 't.service_cat_id', '=', 'c.id')
            ->where('c.status', 1)->orderBy('c.sort')
            ->get(['c.id', 't.locale', 't.title', 't.slug']);

        $link = function (string $locale, string $path, string $text): string {
            return '<a href="/' . $locale . '/' . $path . '">' . e($text) . '</a>';
        };
        $service = function (int $id, string $locale, ?string $text = null) use ($services, $link): string {
            $row = $services->first(fn ($s) => (int) $s->id === $id && $s->locale === $locale);

            return $row && $row->slug
                ? $link($locale, 'services/' . rawurlencode($row->slug), $text ?? $row->title)
                : e($text ?? ($row->title ?? ''));
        };
        $serviceList = fn (string $locale) => $services->where('locale', $locale)
            ->map(fn ($s) => $service($s->id, $locale))->implode($locale === 'ar' ? '، ' : ', ');

        return [
            [
                'title' => ['ar' => 'عن حلول', 'en' => 'About HULUL'],
                'questions' => [
                    [
                        'ar' => ['ما هي شركة حلول؟', 'حلول (HULUL) وكالة تسويق رقمي وإنتاج إعلامي، مكتبها في الدقي بالقاهرة وفرعها في جدة. نقدم للشركات في مصر والسعودية خدمات بناء العلامات التجارية، التسويق الإلكتروني، تطوير المواقع والتطبيقات، وإنتاج المحتوى. تعرّف علينا أكثر في صفحة ' . $link('ar', 'about-us', 'من نحن') . '.'],
                        'en' => ['What is HULUL?', 'HULUL is a digital marketing and media production agency with an office in Dokki, Cairo and a branch in Jeddah. We help businesses in Egypt and Saudi Arabia with branding, digital marketing, website and app development, and content production. Read more on our ' . $link('en', 'about-us', 'About Us') . ' page.'],
                    ],
                    [
                        'ar' => ['أين تقع مكاتب حلول؟', 'في مصر: ' . e($setting('address_ar')) . '. وفي السعودية: ' . e($setting('address_ksa_ar')) . '. أرقام التواصل وواتساب لكل فرع في صفحة ' . $link('ar', 'contact-us', 'اتصل بنا') . '.'],
                        'en' => ['Where are HULUL\'s offices?', 'In Egypt: ' . e($setting('address_en')) . '. In Saudi Arabia: ' . e($setting('address_ksa_en')) . '. Phone and WhatsApp numbers for each office are on our ' . $link('en', 'contact-us', 'Contact Us') . ' page.'],
                    ],
                    [
                        'ar' => ['هل تعملون مع شركات في السعودية؟', 'نعم. نخدم عملاءنا في السعودية من فرعنا في جدة، وعملاءنا في مصر من مكتبنا في القاهرة. شاهد نماذج من مشاريعنا في البلدين في صفحة ' . $link('ar', 'portfolio', 'أعمالنا') . '.'],
                        'en' => ['Do you work with companies in Saudi Arabia?', 'Yes. We serve clients in Saudi Arabia from our Jeddah branch and clients in Egypt from our Cairo office. See projects from both countries in ' . $link('en', 'portfolio', 'our work') . '.'],
                    ],
                ],
            ],
            [
                'title' => ['ar' => 'الخدمات', 'en' => 'Services'],
                'questions' => [
                    [
                        'ar' => ['ما الخدمات التي تقدمها حلول؟', 'نقدم: ' . $serviceList('ar') . '.'],
                        'en' => ['What services does HULUL offer?', 'Our services: ' . $serviceList('en') . '.'],
                    ],
                    [
                        'ar' => ['هل تقدمون خدمات تحسين محركات البحث (SEO) والإعلانات الممولة؟', 'نعم، ضمن ' . $service(21, 'ar') . ': إدارة منصات التواصل الاجتماعي، التسويق بالمحتوى، الحملات الإعلانية الممولة، تحسين محركات البحث SEO، الخطط التسويقية، والتسويق بالبريد الإلكتروني.'],
                        'en' => ['Do you offer SEO and paid advertising?', 'Yes, as part of our ' . $service(21, 'en') . ': social media management, content marketing, paid ad campaigns, SEO, marketing strategy plans and email marketing.'],
                    ],
                    [
                        'ar' => ['هل تصممون المواقع الإلكترونية وتطبيقات الجوال؟', 'نعم. نصمم ونبرمج المواقع الإلكترونية والمتاجر الإلكترونية وتطبيقات الجوال، مع تصميم واجهة المستخدم وتجربة الاستخدام (UI/UX). التفاصيل في صفحة ' . $service(6, 'ar') . '.'],
                        'en' => ['Do you build websites and mobile apps?', 'Yes. We design and develop websites, e-commerce stores and mobile apps, including UI/UX design. Details on our ' . $service(6, 'en') . ' page.'],
                    ],
                    [
                        'ar' => ['هل تقدمون دورات تدريبية؟', 'نعم، نقدم دورات تدريبية عملية في التسويق الرقمي، الإعلانات، صناعة المحتوى، والتصميم. التفاصيل في صفحة ' . $service(27, 'ar') . '.'],
                        'en' => ['Do you offer training courses?', 'Yes, we run practical training courses in digital marketing, advertising, content creation and design. Details on our ' . $service(27, 'en') . ' page.'],
                    ],
                ],
            ],
            [
                'title' => ['ar' => 'التعامل معنا', 'en' => 'Working with us'],
                'questions' => [
                    [
                        'ar' => ['كيف أطلب خدمة أو عرض سعر؟', 'املأ نموذج ' . $link('ar', 'service_request', 'طلب خدمة') . '، أو اتصل بنا أو راسلنا على واتساب من صفحة ' . $link('ar', 'contact-us', 'اتصل بنا') . '، وسيرد عليك فريقنا.'],
                        'en' => ['How do I request a service or a quote?', 'Fill in the ' . $link('en', 'service_request', 'service request') . ' form, or call or message us on WhatsApp from our ' . $link('en', 'contact-us', 'Contact Us') . ' page, and our team will get back to you.'],
                    ],
                    [
                        'ar' => ['كم تكلفة الخدمة؟', 'تختلف التكلفة حسب نوع الخدمة وحجم المشروع، لذلك نحدد السعر بعد التعرف على احتياجاتك. اطلب عرض سعر من نموذج ' . $link('ar', 'service_request', 'طلب خدمة') . '.'],
                        'en' => ['How much do your services cost?', 'It depends on the service and the size of the project, so we price it once we understand what you need. Ask for a quote through the ' . $link('en', 'service_request', 'service request') . ' form.'],
                    ],
                    [
                        'ar' => ['هل يمكنني مشاهدة أعمال سابقة لكم؟', 'نعم. في صفحة ' . $link('ar', 'portfolio', 'أعمالنا') . ' نماذج من مشاريعنا لعملاء في مصر والسعودية: هويات بصرية، تصميمات سوشيال ميديا، مواقع إلكترونية، وفيديوهات إعلانية.'],
                        'en' => ['Can I see your previous work?', 'Yes. ' . $link('en', 'portfolio', 'Our work') . ' shows projects for clients in Egypt and Saudi Arabia: brand identities, social media designs, websites and promotional videos.'],
                    ],
                ],
            ],
        ];
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
