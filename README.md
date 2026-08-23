# 📰 BlogWebApp — Persian News/Blog Platform

[English](#english) | [فارسی](#فارسی)

A Persian-language news and blog platform built with Laravel 12, featuring a full editorial dashboard, a **Repository + Service layered architecture**, a self-built referral/traffic-analytics system, Google reCAPTCHA-protected forms, and social login.

یک پلتفرم خبری/بلاگ فارسی‌زبان، ساخته‌شده با لاراول ۱۲، شامل یک داشبورد کامل تحریریه، معماری لایه‌بندی‌شده با **Repository + Service**، یک سیستم خودساخته‌ی تحلیل ریفرال/ترافیک، فرم‌های محافظت‌شده با گوگل reCAPTCHA، و ورود از طریق شبکه‌های اجتماعی.

---

## English

### Overview
BlogWebApp is a magazine-style content platform: writers publish articles across categories (with multimedia/video articles supported), readers comment and like, and admins manage everything from a dedicated dashboard with real visitor analytics. The codebase is smaller in scope than an e-commerce platform, but consistently applies solid architectural separation throughout.

### ✨ Key Strengths

#### 🏗️ Consistent Repository + Service Layering
- Every major entity (`Article`, `Category`, `User`, `FileManager`) has its own **Repository** bound to an **Interface**, so controllers depend on abstractions rather than concrete Eloquent queries — making it straightforward to swap implementations or mock data access in tests.
- A separate **Service layer** (`Dashboard\ArticleService`, `Dashboard\UserService`, `Dashboard\StatisticsService`, `Dashboard\TrafficStatService`) sits on top of the repositories, handling business logic and cross-cutting concerns like file uploads — keeping controllers focused purely on HTTP concerns.
- `ArticleIndexService` is a great example of read-side design: it centralizes every homepage query variant (`getTrending`, `getTopByLikes`, `getVideoArticles`, `getByCategory`) behind one class with a shared `baseQuery()`, instead of duplicating eager-loading and column-selection logic across controllers.

#### 📊 Self-Built Traffic & Referral Analytics
- `TrafficStatMiddleware` logs a visit per request, and `TrackReferralMiddleware` inspects the `Referer` header to classify traffic sources (Google, Bing, Instagram, direct, or other) — all without pulling in a third-party analytics service, giving the dashboard first-party visitor insights out of the box.
- Referral detection correctly guards against double-counting: it only records one referral per session (`session()->has('tracked_referral')`) and only when the referrer is genuinely external to the app's own domain.

#### 🔐 Real Bot & Spam Protection
- A custom `GoogleRecaptcha` validation rule implements Laravel's `ValidationRule` contract, calling Google's `siteverify` API directly inside a form request — with support for action-based and score-based verification (reCAPTCHA v3), not just a simple pass/fail checkbox.
- Clear, user-facing Persian error messages distinguish between different failure modes (verification service unreachable, failed verification, action mismatch, low trust score) instead of one generic error.

#### 🌍 Multi-Provider Social Login with Sensible Fallbacks
- `SocialLoginController` handles OAuth login generically across drivers via Socialite, linking to an existing account by email or transparently creating a new one — complete with a randomly generated password and a welcome email dispatched through the event system for new accounts.

#### 📨 Event-Driven Transactional Email
- Registration, password resets, and newsletter subscriptions all follow the same clean pattern: **Event → Listener → queued Job → Mailable**, so sending a welcome email or a new-password email never blocks the request that triggered it.

#### 🌐 Practical Iran-Focused Integrations
- A `CurrencyApiService` fetches live gold/currency exchange rates from a Persian market data API, likely powering a ticker or widget relevant to an Iranian readership.
- Persian (Jalali) calendar support via `hekmatinasser/verta`, plus a dedicated `JalaliDate` helper.
- Full `fa`/`en` language files and an RTL stylesheet (`style-rtl.css`) for genuine bilingual support, not just an afterthought translation layer.

#### 🧩 Thoughtful Small Details
- `Article`'s `slug` mutator automatically generates a slug from the title when none is provided (`makeSlug($value ?? $this->title)`), and the model uses `slug` as its route key — clean, SEO-friendly URLs without extra controller code.
- A dedicated `RedirectWithToastHelper` centralizes flash-message redirects, keeping toast notifications consistent across the whole app instead of manually setting session flash data everywhere.

### 🛠️ Tech Stack
- **Backend:** PHP 8.2, Laravel 12
- **Auth:** Laravel's built-in auth, Socialite (social login), Google reCAPTCHA
- **Persian Support:** `hekmatinasser/verta` (Jalali calendar)
- **Media:** `intervention/image-laravel`, custom file manager
- **Frontend:** Vite, Blade, TinyMCE, Swiper.js

### 🚀 Getting Started
```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

npm run dev
php artisan serve
```

Make sure to configure your Google reCAPTCHA keys, social login credentials, and currency API key in `.env` before testing those features.

---

## فارسی

### معرفی
BlogWebApp یک پلتفرم محتوایی به سبک مجله است: نویسندگان مقاله‌هایی در دسته‌بندی‌های مختلف منتشر می‌کنند (با پشتیبانی از مقاله‌های چندرسانه‌ای/ویدیویی)، خوانندگان کامنت و لایک می‌گذارند، و ادمین‌ها همه‌چیز را از یک داشبورد اختصاصی همراه با تحلیل واقعی بازدیدکننده مدیریت می‌کنند. این کدبیس از نظر دامنه کوچک‌تر از یک پلتفرم فروشگاهی است، اما جداسازی معماری قوی را به‌طور پیوسته در سراسر پروژه اعمال کرده.

### ✨ نقاط قوت اصلی

#### 🏗️ لایه‌بندی پیوسته با Repository + Service
- هر موجودیت اصلی (`Article`, `Category`, `User`, `FileManager`) یک **Repository** اختصاصی دارد که به یک **Interface** متصل شده، بنابراین کنترلرها به انتزاع‌ها وابسته‌اند نه کوئری‌های مستقیم Eloquent — که جایگزین‌کردن پیاده‌سازی یا mock کردن دسترسی به داده در تست‌ها را ساده می‌کند.
- یک **لایه‌ی Service** جداگانه (`Dashboard\ArticleService`, `Dashboard\UserService`, `Dashboard\StatisticsService`, `Dashboard\TrafficStatService`) روی Repositoryها قرار گرفته و منطق کسب‌وکار و دغدغه‌های عرضی مثل آپلود فایل را مدیریت می‌کند — و کنترلرها را فقط متمرکز بر مسائل HTTP نگه می‌دارد.
- `ArticleIndexService` نمونه‌ی خوبی از طراحی سمت خواندن است: تمام حالت‌های مختلف کوئری صفحه‌ی اصلی (`getTrending`, `getTopByLikes`, `getVideoArticles`, `getByCategory`) را پشت یک کلاس با `baseQuery()` مشترک متمرکز می‌کند، به‌جای تکرار منطق eager-loading و انتخاب ستون در چند کنترلر.

#### 📊 تحلیل ترافیک و ریفرال خودساخته
- `TrafficStatMiddleware` هر درخواست را به‌عنوان یک بازدید ثبت می‌کند، و `TrackReferralMiddleware` هدر `Referer` را بررسی کرده تا منابع ترافیک را دسته‌بندی کند (گوگل، بینگ، اینستاگرام، مستقیم، یا سایر) — همه بدون استفاده از سرویس تحلیل شخص‌ثالث، و این یعنی داشبورد بینش بازدیدکننده‌ی first-party دارد بدون نیاز به هیچ ابزار خارجی.
- تشخیص ریفرال به‌درستی در برابر شمارش دوباره محافظت می‌کند: فقط یک ریفرال در هر سشن ثبت می‌شود (`session()->has('tracked_referral')`) و فقط زمانی که ریفرر واقعاً خارج از دامنه‌ی خود برنامه باشد.

#### 🔐 محافظت واقعی در برابر بات و اسپم
- یک قانون اعتبارسنجی اختصاصی به نام `GoogleRecaptcha`، قرارداد `ValidationRule` لاراول را پیاده‌سازی می‌کند و مستقیماً درون یک Form Request، API `siteverify` گوگل را فراخوانی می‌کند — با پشتیبانی از اعتبارسنجی مبتنی بر اکشن و امتیاز (reCAPTCHA نسخه ۳)، نه فقط یک چک‌باکس ساده‌ی قبول/رد.
- پیام‌های خطای فارسی و واضح برای کاربر، حالت‌های شکست مختلف را از هم تفکیک می‌کنند (عدم دسترسی به سرویس اعتبارسنجی، شکست اعتبارسنجی، عدم تطابق اکشن، امتیاز اعتماد پایین) به‌جای یک پیام خطای کلی و یکسان.

#### 🌍 ورود اجتماعی چندسرویسه با جایگزین‌های منطقی
- `SocialLoginController` ورود OAuth را به‌طور عمومی و مستقل از درایور، از طریق Socialite مدیریت می‌کند، و کاربر را با ایمیل به حساب موجود متصل می‌کند یا به‌طور شفاف یک حساب جدید می‌سازد — همراه با یک رمز عبور تصادفی و یک ایمیل خوش‌آمدگویی که برای حساب‌های جدید از طریق سیستم Event ارسال می‌شود.

#### 📨 ایمیل تراکنشی مبتنی بر Event
- ثبت‌نام، بازیابی رمز عبور، و اشتراک خبرنامه همگی از یک الگوی تمیز یکسان پیروی می‌کنند: **Event → Listener → Job صف‌شده → Mailable**، بنابراین ارسال ایمیل خوش‌آمدگویی یا ایمیل رمز جدید هرگز درخواستی که آن را فعال کرده را مسدود نمی‌کند.

#### 🌐 یکپارچه‌سازی‌های کاربردی متمرکز بر ایران
- یک `CurrencyApiService` نرخ زنده‌ی طلا/ارز را از یک API داده‌ی بازار فارسی دریافت می‌کند، که به‌احتمال زیاد یک ticker یا ویجت مرتبط با مخاطب ایرانی را تغذیه می‌کند.
- پشتیبانی از تقویم جلالی از طریق `hekmatinasser/verta`، به‌علاوه یک هلپر اختصاصی `JalaliDate`.
- فایل‌های زبان کامل `fa`/`en` و یک استایل‌شیت RTL (`style-rtl.css`) برای پشتیبانی واقعی دوزبانه، نه فقط یک لایه‌ی ترجمه‌ی بعداً اضافه‌شده.

#### 🧩 جزئیات کوچک اما هوشمندانه
- Mutator مربوط به `slug` در مدل `Article` به‌طور خودکار، در صورت نبود ورودی، اسلاگ را از عنوان می‌سازد (`makeSlug($value ?? $this->title)`)، و مدل از `slug` به‌عنوان کلید روت استفاده می‌کند — یعنی URLهای تمیز و مناسب SEO بدون نیاز به کد اضافه در کنترلر.
- یک `RedirectWithToastHelper` اختصاصی، ریدایرکت‌های همراه با پیام Flash را در یک‌جا متمرکز می‌کند و نوتیفیکیشن‌های Toast را در کل برنامه یکدست نگه می‌دارد، به‌جای تنظیم دستی داده‌ی Flash سشن در همه‌جا.

### 🛠️ تکنولوژی‌های استفاده‌شده
- **بک‌اند:** PHP 8.2، Laravel 12
- **احراز هویت:** سیستم احراز هویت داخلی لاراول، Socialite (ورود اجتماعی)، Google reCAPTCHA
- **پشتیبانی فارسی:** `hekmatinasser/verta` (تقویم جلالی)
- **رسانه:** `intervention/image-laravel`، مدیر فایل اختصاصی
- **فرانت‌اند:** Vite، Blade، TinyMCE، Swiper.js

### 🚀 راه‌اندازی پروژه
```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

npm run dev
php artisan serve
```

پیش از تست این قابلیت‌ها، حتماً کلیدهای Google reCAPTCHA، اطلاعات ورود اجتماعی، و کلید API ارز را در فایل `.env` تنظیم کنید.

---

## 📄 License
This project is open-sourced software.
این پروژه به‌صورت متن‌باز منتشر شده است.
