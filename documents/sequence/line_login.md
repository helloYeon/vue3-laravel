@startuml
skin rose

title ラインログイン ver.20230514
actor User as U
participant "vue-sample" as VS
database    MYSQL    as DB
participant "line auth \n (Line Server)" as LI

VS -> VS: 1. LINE認証用URL作成
VS -> DB: 2. state登録
VS --> U: 3. ユーザーに認証URL
U -> LI: 4. LINE認証用URLクリック
LI --> VS: Callback（認可コード等）

activate VS
VS -> VS: セキュリティーチェック
VS -> LI: 5. アクセストークン取得要求
LI --> VS: 6. アクセストークン
VS -> LI: 7.フロフィール要求
VS -> DB: 8. ユーザ情報登録
deactivate VS

alt 成功
  VS -> U: ログイン完了画面へ
else 失敗
  VS -> U: ログイン失敗画面へ
end
@enduml
