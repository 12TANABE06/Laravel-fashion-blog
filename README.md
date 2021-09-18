<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

ーーーーーここからーーーーー
# アプリ名
Fashion Blog
# 概要
ユーザー認証付きの画像投稿機能を有したSNS型ファッションブログサービス
# 使用言語
Laravel6,bootstrap4,PHP(ver.7.3.28),html,css,Javascript
# 機能
- ユーザー認証機能
- Goole APIを用いたGooleアカウントでのユーザー認証機能
- 投稿の一覧表示、投稿の詳細表示、最大２枚の画像とハッシュタグとコメントを投稿できる投稿（画像は最低１枚は必須）と編集（ハッシュタグとコメントのみ）と削除機能
- 投稿の検索機能（ユーザー名、ハッシュタグ、コメントから検索）、非同期のいいね機能といいね数によるランキング機能
- マイページ機能（プロフィール画像と自己紹介文の投稿と編集と削除機能
    - 自分の投稿と自分がいいねした投稿の一覧表示、ユーザー名の編集機能）
# 非機能
画像ファイルの保存のためAWSのS3の使用
# 注力した機能
今回このWebアプリケーションを作成したきっかけとして普段使用しているアプリにはない画像の複数枚投稿機能を有したもの作成するため、画像の複数枚投稿機能に注力した。またユーザーとして様々なファッションを参考にし、自分のファッションに活かす目的があるため、重要な機能となるお気に入りの投稿を保存する機能としていいね機能、ハッシュタグなどからの検索機能にも注力をした。
# 工夫した点
スマートフォンで撮影した画像はファイルサイズが大きく投稿ができないことがあるため、アップロードサイズの上限を変更し対応した。
改行やインデントを統一し見やすさを意識した。
# 環境構築の手順

# デモ
テストアカウントとしてメールアドレス:test1@mail.com パスワード：test1test1　を使用可能。

# 注意点
動作環境はPCサイズを想定し作成しているため、PCの画面サイズでの動作確認を希望する。

今後改善したいと考えるものとして3つある。
- スマートフォンサイズへのサイズの調整であり、現時点ではスマートフォンでの閲覧は表示サイズの問題で使用しずらい状態にあるため、PCとスマートフォンの両方に対応させたいと考えている。
- 画像表示について画像の大きさを統一することが出来ていないため、画像を保存する際に画像を加工して保存し統一できる機能を実現したいと考えている。
- 非同期のいいね機能を実装するのにjQueryをしようして実現したがVue.jsを用いてコードの行数が多くなってしまったbladeを書き換えて実現をしたいと考える。



