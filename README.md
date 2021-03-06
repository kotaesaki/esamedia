* [ポートフォリオ紹介](#ポートフォリオ紹介)
    * [トップページ](#トップページ)
    * [環境](#環境)
* [設計](#設計)
    * [ER図](#ER図)
    * [画面一覧表](#画面一覧表)
    * [機能一覧表](#機能一覧表)
    * [画面遷移図](#画面遷移図)
* [開発](#開発)
    * [全体](#全体)
    * [フロントエンド](#フロントエンド)
    * [バックエンド](#バックエンド)
    * [インフラストラクチャ+DevOps](#インフラストラクチャdevops)

<a id="#anchor1"></a>

# ポートフォリオ紹介

トップページ:[http://esamedia.herokuapp.com](http://esamedia.herokuapp.com/admin)

管理者ページ:[http://esamedia.herokuapp.com/admin](http://esamedia.herokuapp.com/admin)

CMSを使わずにメディアサイトを開発しました。

CRUD処理やログイン処理を学ぶにはメディアサイトの構築は勉強になりました。

制作期間は２週間です。

管理者ページにはゲストログイン機能もございますので、是非一度触れてみてください。

<a id="#anchor11"></a>

## トップページ

*パソコン*

管理者ページ

![https://user-images.githubusercontent.com/65902454/111035430-e2649680-845d-11eb-82f6-1d5a60570196.png](https://user-images.githubusercontent.com/65902454/111035430-e2649680-845d-11eb-82f6-1d5a60570196.png)

トップページ

![https://user-images.githubusercontent.com/65902454/111035487-29eb2280-845e-11eb-9270-2cb72b25f5bb.png](https://user-images.githubusercontent.com/65902454/111035487-29eb2280-845e-11eb-9270-2cb72b25f5bb.png)

*スマートフォン+タブレット*

<img src="https://user-images.githubusercontent.com/65902454/111038760-ffa16100-846d-11eb-8906-1eadefd293c6.PNG" width="30%">
<img src="https://user-images.githubusercontent.com/65902454/111038764-04661500-846e-11eb-9a99-1f7220fd80e4.PNG" width="30%">

<a id="#anchor12"></a>

## 環境

- PHP 7.3
- Laravel 8.12
- Docker 19.03.13
- Docker Compose 1.27.4
- Heroku
- nginx 1.18 (開発環境)
- MySQL 8.0(開発環境)

<a id="#anchor2"></a>

# 設計

<a id="#anchor21"></a>

## ER図

<a id="#anchor22"></a>

## 画面一覧表

| No. | 画面名               | 階層1          | 階層2        | 階層3            | 未ログイン表示可否 |
|-----|----------------------|----------------|--------------|------------------|--------------------|
|   1 | トップ画面           | トップ         | -            | -                | ◎                  |
|   2 | 個別画面             | トップ         | 個別         | -                | ◎                  |
|   3 | 投稿一覧画面         | ダッシュボード | 投稿一覧     | -                | ○                  |
|   4 | 新規投稿画面         | ダッシュボード | 新規投稿     | -                | ○                  |
|   5 | 編集投稿画面         | ダッシュボード | 編集一覧     | -                | ○                  |
|   6 | コメント一覧画面     | ダッシュボード | コメント一覧 | -                | ○                  |
|   7 | ユーザー登録画面     | ダッシュボード | ユーザー登録 | -                | ○                  |
|   8 | カテゴリ一覧画面     | ダッシュボード | カテゴリ一覧 | -                | ○                  |
|   9 | タグ一覧画面         | ダッシュボード | タグ一覧     | -                | ○                  |
|  10 | ユーザー一覧画面     | ダッシュボード | ユーザー一覧 | -                | △                  |
|  11 | ユーザー削除確認画面 | ダッシュボード | ユーザー一覧 | ユーザー削除確認 | △                  |
|  12 | ログイン画面         | ログイン画面   | -            | -                | ◎                  |

◎: 全ユーザー
○: 編集者
△: 管理者

<a id="#anchor23"></a>

## 機能一覧表

| No. | 大機能   | 中機能           | 使用可否 |
|-----|----------|------------------|----------|
|   1 | 記事     | 記事一覧(トップ) | ◎        |
|   2 | 記事     | 記事一覧(管理者) | ○        |
|   3 | 記事     | 記事作成         | ○        |
|   4 | 記事     | 記事削除         | ○        |
|   5 | 記事     | 記事更新         | ○        |
|   6 | 記事     | 記事絞り込み     | ◎        |
|   7 | 検索     | キーワード検索   | ◎        |
|   8 | ユーザー | ログイン         | ◎        |
|   9 | ユーザー | 新規登録         | ○        |
|  10 | ユーザー | ログアウト       | ○        |
|  11 | ユーザー | ユーザー削除     | △        |
|  12 | コメント | コメント作成     | ◎        |
|  13 | コメント | コメント一覧     | ○        |
|  14 | コメント | コメント削除     | ○        |
|  15 | カテゴリ | カテゴリ一覧     | ○        |
|  16 | カテゴリ | カトゴリ作成     | ○        |
|  17 | カテゴリ | カテゴリ削除     | ○        |
|  18 | カテゴリ | カテゴリ編集     | ○        |
|  19 | タグ     | タグ一覧         | ○        |
|  20 | タグ     | タグ作成         | ○        |
|  21 | タグ     | タグ削除         | ○        |
|  22 | タグ     | タグ編集         | ○        |

◎: 全ユーザー
○: 編集者
△: 管理者

<a id="#anchor24"></a>

## 画面遷移図

<a id="#anchor3"></a>

# 開発

<a id="#anchor31"></a>

## 全体

- PHP 7.3
- Laravel 8.12
- Docker 19.03.13
- Docker Compose 1.27.4
- Heroku
- nginx 1.18 (開発環境)
- MySQL 8.0(開発環境)
<a id="#anchor32"></a>

## フロントエンド

- Blade

初めてガッツリとLaravelを触るため、Bladeを採用しました。


<a id="#anchor33"></a>
## バックエンド

- PHP 7.3
- Laravel 8.12
- PHPUnit

管理者サイトでは記事、タグ、カテゴリ、コメントのCRUD処理を開発しました。

管理者と編集者でユーザーの権限を分け、ユーザー削除は管理者のみ実施できるようにしました。

テストにはPHPUnitを採用しました。

<a id="#anchor34"></a>

## インフラストラクチャ+DevOps

- Docker 19.03.13
- Docker Compose 1.27.4
- Heroku
- GitHub

サーバにはHerokuを採用しました。

Heroku CLIからコマンドでデプロイ出来るようにしました。

Webサーバにはapache、データベースにはMySQLを利用しました。
