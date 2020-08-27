create table drinklist(
drink_id Int(11),
name varchar(255),
price int(11),
number int(11));

desc drinklist;

insert into drinklist values
(1,"オレンジジュース",150,5),
(2,"オレンジジュース",130,4),
(3,"ミネラルウォーター",80,7),
(4,"コーラ",120,6);

select * from drinklist:

create table user_table (
    user_id int(11),
    name varchar(255),
    age int(11),
    tel varchar(255),
    mail varchar(255));

CREATE TABLE contactform(
    name varchar(255),
    mail varchar(255),
    age int(11),
    comments varchar(255)
);

insert into user_table values
(1,"山田太郎",24,"090-1234-5678","yamada@gmail.com"),
(2,"佐藤次郎",22,"090-2345-9999","sato@gmail.com"),
(3,"鈴木花子",26,"080-7777-8888","suzuki@gmail.com");

select * from user_table;


create table customer_data (
    id int(11),
    name varchar(255),
    mail varchar(255),
    tel varchar(255)
);

desc customer_data;

insert into customer_data VALUES
(1,"山田太郎","y.taro@gmail.com","03-1511-3333"),
(2,"佐藤花子","h.sato@yahoo.co.jp","090-7724-8842"),
(3,"田中次郎","tziro@gmail.com","080-8824-4445"),
(4,"鈴木三郎","sabuszk@gmail.com","090-2224-8424");

select * from customer_data;

select * from customer_data where id = 1;

select name from customer_data;

select name,mail from customer_data where id >= 3;

select * from customer_data where mail like "%@gmail.com%";

update customer_data set tel ="03-0000-0000" where id=1;
select * from customer_data;

delete from customer_data where id=2;
select * from customer_data;

select count(fruit) from fruit_stock where madein="フィリピン";

create table members_data (
    name varchar(255),
    mail varchar(255),
    password varchar(255),
    prof_img varchar(255),
    comments varchar(255)
);







/*コマンドプロンプト*/


mysql -u root -p


create database lesson02;
show databases;

use lesson02;

create table item(
    item_id int,
    item_name varchar(255),
    item_team enum('spring','summer','fall','winter'),
    price decimal(9,2)
);

desc item;

insert into item(item_id,item_name,item_team,price) values
(1,'りんご','summer',150),
(2,'ぶどう','fall',200),
(3,'さつまいも','fall',250),
(4,'ネギ','winter',190),
(5,'にんじん','spring',50),
(6,'トマト','summer',100);

select * from item;

select item_name from item;

update item set item_name="りんご" where item_id=1;

show variables like "chara%";

select item_name from item;

update item set item_team="winter" where item_id=1;
update item set price = 500 where item_id=1;
update table_b set fruit_id= 1 where place='長野';
show tables;
/*--------------------------------
作成後のテーブル構造の変更
--------------------------------*/
/*テーブル構造の表示*/
desc テーブル名;

/*テーブル名の変更*/
alter table 現テーブル名 rename 新テーブル名;

/* カラム名の変更 */
alter table テーブル名 change 現カラム名 新カラム名 int;

/*データ型の変更*/
alter table テーブル名 modify カラム名 データ型;

/*カラムの追加*/
alter table テーブル名 add カラム名 データ型;

/*カラムを削除*/
alter table テーブル名 drop カラム名;

/*--------------------------------
テーブル結合
--------------------------------*/
/*内部結合*/
select カラム名 from テーブル１ inner join テーブル2 on 結合の条件;
テーブル1の中で on の後ろで指定した条件と合致したデータを、テーブル2から取得する
select * from table_a inner join table_b on table_a.fruit_id=table_b.fruit_id;
+----------+--------+-------+----------+--------+-------+
| fruit_id | name   | price | fruit_id | place  | stock |
+----------+--------+-------+----------+--------+-------+
|        1 | りんご |   100 |        1 | 青森   |     5 |
|        2 | みかん |   150 |        2 | 愛媛   |    30 |
|        3 | バナナ |   140 |        3 | 沖縄   |    20 |
|        1 | りんご |   100 |        1 | 長野   |    10 |
|        2 | みかん |   150 |        2 | 和歌山 |    25 |
+----------+--------+-------+----------+--------+-------+
select * from table_b inner join table_c on table_b.place=table_c.place;
+----------+--------+-------+--------+--------------+
| fruit_id | place  | stock | place  | shipping_fee |
+----------+--------+-------+--------+--------------+
|        1 | 青森   |     5 | 青森   |          400 |
|        2 | 愛媛   |    30 | 愛媛   |          400 |
|        3 | 沖縄   |    20 | 沖縄   |          650 |
|        4 | 東京   |    50 | 東京   |          250 |
|        1 | 長野   |    10 | 長野   |          350 |
|        2 | 和歌山 |    25 | 和歌山 |          350 |
+----------+--------+-------+--------+--------------+

/*左外部結合*/
select カラム名 from テーブル１ left outer join テーブル2 on 結合の条件;
テーブル1が基準となり、テーブル2から結合条件にマッチするものを取得する
select * from table_b left outer join table_a on table_a.fruit_id=table_b.fruit_id;
+----------+--------+-------+----------+--------+-------+
| fruit_id | place  | stock | fruit_id | name   | price |
+----------+--------+-------+----------+--------+-------+
|        1 | 青森   |     5 |        1 | りんご |   100 |
|        1 | 長野   |    10 |        1 | りんご |   100 |
|        2 | 愛媛   |    30 |        2 | みかん |   150 |
|        2 | 和歌山 |    25 |        2 | みかん |   150 |
|        3 | 沖縄   |    20 |        3 | バナナ |   140 |
|        4 | 東京   |    50 |     NULL | NULL   |  NULL |
+----------+--------+-------+----------+--------+-------+

/*右外部結合*/
select カラム名 from テーブル１ right outer join テーブル2 on 結合の条件;
テーブル2が基準となり、テーブル1から結合条件にマッチするものを取得する
select * from table_a right outer join table_b on table_a.fruit_id=table_b.fruit_id;
+----------+--------+-------+----------+--------+-------+
| fruit_id | name   | price | fruit_id | place  | stock |
+----------+--------+-------+----------+--------+-------+
|        1 | りんご |   100 |        1 | 青森   |     5 |
|        1 | りんご |   100 |        1 | 長野   |    10 |
|        2 | みかん |   150 |        2 | 愛媛   |    30 |
|        2 | みかん |   150 |        2 | 和歌山 |    25 |
|        3 | バナナ |   140 |        3 | 沖縄   |    20 |
|     NULL | NULL   |  NULL |        4 | 東京   |    50 |
+----------+--------+-------+----------+--------+-------+

/*--------------------------------
フィールドオプション
--------------------------------*/
/*テーブル構造の表示*/
not null         入力を必要とする
auto_increment 　自動で連番をつける
primary key      全レコードで一意を保証するための主キー
unique           重複した値を登録できなくする
foreign key      外部テーブルとリンクするためのキー






create table table_a(
    fuit_id int,
    name varchar(255),
    price int
);

insert into table_a values
(1,'りんご',100),
(2,'みかん',150),
(3,'バナナ',140);

create table table_b(
    fruit_id int,
    place varchar(255),
    stock int
);

create table table_c(
    place varchar(255),
    shipping_fee int
);

insert into table_c values
('青森',400),
('愛媛',400),
('沖縄',650),
('東京',250),
('長野',350),
('和歌山',350);

create table customer_data (
    id int(11),
    name varchar(255),
    mail varchar(255),
    tel varchar(255)
);

create table 4each_keijiban(
    handlename varchar(255),
    title varchar(255),
    comments varchar(255)
);
