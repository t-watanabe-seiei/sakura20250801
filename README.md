# 小学1年生向け減法練習Webアプリ

## アプリ概要
このWebアプリは、小学1年生が「10以下の数から1位数をひく減法」を楽しく練習できる学習ツールです。問題はランダムに出題され、解答結果はすぐにフィードバックされます。履歴も自動で保存され、保護者や先生が学習状況を確認できます。

## 使い方
1. アプリにアクセスすると、減法問題が表示されます。
2. 答えを入力して「こたえを送信」ボタンを押します。
3. 正誤判定が表示され、次の問題に進めます。
4. 「これまでのれきしを見る」ボタンで過去の解答履歴を確認できます。

## 特徴
- ログイン不要、個人情報不要で安心
- 小学校1年生でも直感的に使えるシンプルなデザイン
- 履歴は匿名（セッションID）で保存
- 端末・ブラウザ問わず利用可能

## 画面構成
- トップページ：減法問題の出題・解答フォーム
- 結果表示ページ：正誤判定と次の問題への誘導
- 履歴ページ：過去の解答履歴一覧

## インストール・起動方法
1. 必要なパッケージをインストール
   ```bash
   composer install
   npm install && npm run dev
   ```

1.1 .env ファイルのReName
   ```bash
    mv .env.example .env
   ```
1.2 APP_KEY の更新
   ```bash
    php artisan key:generate
   ```


2.0 データベース
   ```bash
   touch database/database.sqlite
   ```

2. データベースを初期化
   ```bash
   php artisan migrate
   ```
3. サーバーを起動
   ```bash
   php artisan serve
   ```

## .envのMIX_ASSET_URLについて
CSSやJSのパスは、.envのMIX_ASSET_URLでベースURLを指定できます。
例：
```
MIX_ASSET_URL="/"
```
Bladeテンプレートでは
```blade
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script src="{{ mix('js/app.js') }}" defer></script>
```
で自動的にMIX_ASSET_URLが反映されます。

## テスト実行方法
```bash
php artisan test
```

## 注意事項
- 問題は「10以下の数から1位数をひく減法」のみ出題されます。
- 履歴はセッション単位で保存されます。
- 保護者・教師は履歴ページで学習状況を確認できます。

---
ご不明点はREADMEをご参照ください。
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
