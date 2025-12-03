# coachtech-test


## 環境構築

 Docker ビルド
・git clone git@github.com:furamomo/coachtech-test.git
・docker-compose up -d --build

 Laravel 初期設定
・docker-compose exec php bash
・composer install
・cp .env.example .env 環境変数を適宜変更
・php artisan key:generate
・php artisan migrate --seed


## 使用技術（実行環境）

・PHP 8.1（php-fpm）
・Laravel 8.x
・Composer
・MySQL 8.0.26
・nginx 1.21.1
・phpMyAdmin


## コーディング規約

コーディング規約は下記URLを参照しました：
https://estra-inc.notion.site/1263a94a2aab4e3ab81bad77db1cf186  


## ER図

[ER図](./er.png)


## URL

お問い合わせ入力画面： http://localhost

会員登録画面： http://localhost/register

ログイン画面： http://localhost/login

phpMyAdmin： http://localhost:8080/


