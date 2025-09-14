# Food Service Simulation

このプロジェクトは、オブジェクト指向プログラミング（OOP）の四大原則
（カプセル化、抽象化、継承、ポリモーフィズム）を練習するための課題です。
レストランにおける 注文 → 調理 → 請求書生成 の流れを、PHP を用いてシミュレーションします。

## 学習目的

- OOP のクラス設計・継承・依存関係を理解する
- 名前空間や spl_autoload_register を使ったコード分割を学ぶ
- FoodOrder と Invoice の責務分離を理解する
- サーバサイド言語（PHP）での小規模なドメインモデリングを体験する

## システム概要

- Customer: 顧客を表す。興味のある料理と数量を interestedTastedMap に保持。
- Restaurant: レストラン全体を表す。メニューと従業員（Cashier, Chef）を持つ。
- Cashier: レジ係。注文票（FoodOrder）を作成し、Invoice を生成する。
- Chef: シェフ。FoodOrder を受け取り、調理をシミュレーションする。
- FoodItem: 抽象クラス。料理名・説明・価格を持ち、具象クラス（CheeseBurger, Spaghetti 等）が実装。
- FoodOrder: 複数の FoodItem と注文時刻を保持する。
- Invoice: 合計金額・注文時間・調理時間（見積り）を保持する。FoodOrder のサマリ。

## クラス図（概要）
```
Person (abstract)
 ├─ Customer
 └─ Employee (abstract)
      ├─ Cashier
      └─ Chef

Restaurant
 ├─ FoodItem[] menu
 └─ Employee[] employees

FoodItem (abstract)
 ├─ CheeseBurger
 ├─ Spaghetti
 ├─ Fettuccine
 └─ HawaiianPizza

FoodOrder
Invoice
```
## 実行フロー

1. Customer が「食べたい料理リスト（名前と数量）」を持つ
2. Restaurant に order() を呼び出す
3. Cashier が FoodOrder を作成
4. Chef が FoodOrder を受け取り、調理をシミュレーション
5. Cashier が Invoice を作成し、合計金額と調理時間を算出
6. Invoice が呼び出し元に返される

## 出力例
```bash
Tom wanted to eat Margherita, CheeseBurger, Spaghetti.
Tom was looking at the menu, and ordered CheeseBurger × 2, Spaghetti × 1.
Nadia Valentine received the order.
Inayah Lozano was cooking CheeseBurger.
Inayah Lozano was cooking Spaghetti.
Inayah Lozano took 4 minutes to cook.
Nadia Valentine made the invoice.
------------------------------
Date: 2025-03-08 14:13
Final Price: $43.00
```

## 環境

PHP 8.2+

## 実行方法
```bash
php main.php
```