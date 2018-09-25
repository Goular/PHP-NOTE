查出最贵的一件商品的商品信息。
select * from product order by price desc limit 0,1;

查出最大(最新)的商品的编号（ID）。 
select pro_id from product order by pro_id desc limit 0,1;

查出最便宜商品的价格。
select price as 最便宜商品价格 from product order by price asc limit 0,1;

取出最小(最旧)的商品编号。
select pro_id as 最小的商品编号 from product order by pro_id asc limit 0,1;

查出所有商品的总数量。
select count(*) as 商品总数量 from product ;

查出所有商品的平均价格。
select avg(price) as 商品的平均价格 from product ;

查出联想品牌的所有商品的平均价格。
select avg(price) as 联想品牌商品平均价格 from product where pinpai = '联想';

按价格由高到低排序。
select price from product order by price desc;

按商品类型由低到高排序，类型内部按价格由高到低排序。
select * from product order by protype_id asc ,price desc; 

取出价格最高的前三个商品。
select * from product order by price limit 0,3;

查出每个产地各有多少数量的商品
select  chandi as 产地 , count(*) from product group by chandi desc;

查出每个品种各有多少个商品
select protype_id as 品种id , count(*) from product group by protype_id;

