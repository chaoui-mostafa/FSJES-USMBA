# Project Setup Guide

## Prerequisites

* PHP 8.1+
* Composer
* Node.js & npm
* MySQL or PostgreSQL
* Git

## Installation Steps

### 1. Clone the Project

```bash
git clone https://github.com/chaoui-mostafa/la-fac.git
cd la-fac
```

### 2. Install Dependencies

```bash
composer install
npm install 
```

### 3. Set Up Environment Variables

```bash
cp .env.example .env
php artisan key:generate
```

* Update database credentials in `.env` file.

### 4. Database Setup

```bash
php artisan migrate --seed
```

### 5. Storage Linking

```bash
php artisan storage:link
```

### 6. Run the Development Server open 2 terminal 

```bash
php artisan serve
npm run dev 
```

### 7. Access the Application

* Visit `http://localhost:8000` in your browser.

### Additional Commands

* Clear Cache: `php artisan config:cache`
* Update Dependencies: `composer update`

### Arabic Instructions (تعليمات باللغة العربية)

* تأكد من تثبيت المتطلبات المذكورة أعلاه.
* استخدم الأوامر لإنشاء نسخة محلية من المشروع وتثبيت التبعيات.
* قم بتهيئة قاعدة البيانات وتحديث ملف `.env` بمعلومات قاعدة البيانات.
* استخدم `php artisan serve` لتشغيل المشروع محليًا.
