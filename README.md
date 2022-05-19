![スクリーンショット (134)](https://user-images.githubusercontent.com/82688696/141949400-ae33c657-c23d-453a-a4f4-0e34fd67ec0e.png)

# アプリ名
Fashion Blog
# 概要
ユーザー認証付きの画像投稿機能を有したSNS型ファッションブログサービス
- URL: https://fashion-bolg.herokuapp.com/
# 開発背景
開発に取り組んだ理由として、既存の普段利用しているアプリケーションの改善点を改善させたものを作成するためだ。既存のアプリケ―ションでは画像投稿が一枚のみしかできず、複数枚の画像の投稿機能を取り入れた方が良いのではと感じていたため、その点の改良をキーポイントとして制作を行った。
# 使用言語・技術・環境
- Laravel Framework 6.20.27
- PHP(ver.7.3.28)
- Bootstrap v4.6.0 
- HTML
- CSS
- jQuery JavaScript Library v3.6.0
- MariaDB 10.2.36
- AWS（テスト環境）
    - EC2
    - Cloud9
    - S3 
- Heroku(本番環境)
- Google OAuth認証
# 機能
- ユーザー認証機能
- Goole APIを用いたGooleアカウントでのユーザー認証機能
- 投稿の一覧表示、投稿の詳細表示、最大２枚の画像とハッシュタグとコメントを投稿できる投稿（画像は最低１枚は必須）と編集（ハッシュタグとコメントのみ）と削除機能
- 投稿の検索機能（ユーザー名、ハッシュタグ、コメントから検索）、非同期のいいね機能といいね数によるランキング機能
- マイページ機能（プロフィール画像と自己紹介文の投稿と編集と削除機能)
    - 自分の投稿と自分がいいねした投稿の一覧表示、ユーザー名の編集機能）
# 非機能
画像ファイルの保存のためAWSのS3の使用
# 注力した機能
今回このWebアプリケーションを作成したきっかけとして普段使用しているアプリにはない画像の複数枚投稿機能を有したもの作成するため、画像の複数枚投稿機能に注力した。またユーザーとして様々なファッションを参考にし、自分のファッションに活かす目的があるため、重要な機能となるお気に入りの投稿を保存する機能としていいね機能、ハッシュタグなどからの検索機能にも注力をした。
# 工夫した点
- スマートフォンで撮影した画像はファイルサイズが大きく投稿ができないことがあるため、アップロードサイズの上限を変更し対応した。
- 投稿画像を増やすことで、データ量が増え表示速度が遅くなってしまう問題が発生したため、アップロードされた画像をWebp形式に変換しデータ量を抑えることで、表示速度を向上させた。
- 改行やインデントを統一し見やすさを意識した。
# デモ
テストアカウントとしてメールアドレス:test1@mail.com パスワード：test1test1　を使用可能。

# 注意点
動作環境はPCサイズを想定し作成しているため、PCの画面サイズでの動作確認を希望する。

今後改善したいと考えるものとして3つある。
- スマートフォンサイズへのサイズの調整であり、現時点ではスマートフォンでの閲覧は表示サイズの問題で使用しずらい状態にあるため、PCとスマートフォンの両方に対応させたいと考えている。
- 画像表示について画像の大きさを統一することが出来ていないため、画像を保存する際に画像を加工して保存し統一できる機能を実現したいと考えている。
- 非同期のいいね機能を実装するのにjQueryを使用して実現したが、Vue.jsを用いてコードの行数が多くなってしまったbladeの書き換えを実現をしたいと考える。



