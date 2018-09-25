///////////////////////////////////////////////////////////////
//2表查询：
///////////////////////////////////////////////////////////////
1)查出“计算机系”的所有学生信息。 
select * from 学生表 where 院系ID = (
	select 院系ID from 院系 where 院系名称 = '计算机系'
);#运算效率较低
select * from 学生表 inner join 院系 on 学生表.院系ID = 院系.院系ID where 院系名称 = "计算机系";#运算效率较高

2)查出“韩顺平”所在的院系信息。
select * from 院系 where 院系ID = (select 院系ID from 学生表 where 学生 = '韩顺平');#运算效率较低
select * from 院系 inner join 学生表 on 学生表.院系ID = 院系.院系ID where 学生表.学生= '韩顺平';#运算效率较高

3)查出在“行政楼”办公的院系名称。
select 院系名称 from 院系 where 系办地址 like '%行政楼%';


4)查出男生女生各多少人。
select 性别,count(*) from 学生表 group by 性别;

5)查出人数最多的院系信息。(这个是重点,必须认真查看)
select * from 院系 where 院系ID = (
	/*以院系ID做分组，找出院系ID，条件是数量为最大的那个值*/
	select 院系ID from 学生表 group by 院系ID having count(*) = (
		/*找出以院系ID分组的结果中，数量最大的那个数值*/
		select count(*) from 学生表 group by 院系ID order by count(*) desc limit 0,1
	)
);

//首先查找院系信息
select * from 院系 where 院系ID = (
	select 院系ID from 学生表 group by 院系ID having count(*) = (
		select count(*) from 学生表 group by 院系ID order by count(*) desc limit 0,1
	)
) ;



6)查出人数最多的院系的男女生各多少人。
select 性别,count(*) from 学生表 where 院系ID = (
	/*以院系ID做分组，找出院系ID，条件是数量为最大的那个值*/
	select 院系ID from 学生表 group by 院系ID having count(*) = (
		/*找出以院系ID分组的结果中，数量最大的那个数值*/
		select count(*) from 学生表 group by 院系ID order by count(*) desc limit 0,1
	)
) group by 性别;



7)查出跟“罗弟华”同籍贯的所有人。
select * from 学生表 where 籍贯 = (
	select 籍贯 from 学生表 where 学生 = '罗弟华'
);
//如果要排除该人本身，则：
select * from 学生表 where 籍贯 = (
	select 籍贯 from 学生表 where 学生 = '罗弟华'
) and 学生 <> '罗弟华';


8)查出有“河北”人就读的院系信息。
select * from 院系 inner join 学生表 on 院系.院系ID = 学生表.院系ID where 学生表.籍贯 = '河北'； 


9)查出跟“河北女生”同院系的所有学生的信息。
select * from 学生表 where 院系ID in(
	select 院系ID from 学生表 where 籍贯='河北' and 性别 = '女'
);
//如果要排除“河北女生”本身，则：
select * from 学生表 where 院系ID in(
	select 院系ID from 学生表 where 籍贯='河北' and 性别 = '女'
) and not (籍贯 = '河北' and 性别 = '女');

///////////////////////////////////////////////////////////////
//3表查询：
//创建学生表
create table stu (
	id int auto_increment primary key not null,
	name varchar(20),
	gender enum('男','女'),
	class_id tinyint
)charset = utf8 ,comment = '学生表';

//创建课程表
create table kecheng(
	id int auto_increment primary key not null,
	kecheng_name varchar(20)
)charset = utf8;

//创建分数表
create table stu_kecheng(
	id int auto_increment primary key not null,
	stu_id int ,
	kecheng_id int,
	score int
);


///////////////////////////////////////////////////////////////
1)查询选修了 MySQL 的学生姓名；
select * from stu inner join kecheng on kecheng.id = stu.class_id where kecheng.kecheng_name = 'MySQL';
select * from stu where class_id = (
	select id from kecheng where kecheng_name = 'MySQL'
);

2)查询 张三 同学选修了的课程名字；
select kecheng.kecheng_name from kecheng inner join stu on stu.class_id = kecheng.id where stu.name = '张三';
select kecheng_name from kecheng where id = (
	select class_id  from stu where name = '张三'
);

3)查询只选修了1门课程的学生学号和姓名；
select * from stu where id in(
	select stu_id from stu_kecheng group by stu_id having count(*)= 1
);

4)查询选修了至少3门课程的学生信息；
select * from stu where id in (
	select stu_id from stu_kecheng group by stu_id having count(*) >=3
);


5)查询选修了所有课程的学生；
select * from stu where id in (
	select stu_id from stu_kecheng group by stu_id having count(*) = (
		select count(*) from kecheng
	)
);

6)查询选修了课程的总人数；
//第一步：以stu_id为条件进行分组，找出所有选修了课程的学生id
select stu_id from stu_kecheng group by stu_id;
//第2步：以上述结果作为“数据源”，统计其行数，就是选修了课程的学生的数量
select count(*) from (select stu_id from stu_kecheng group by stu_id) as t;


7)查询所学课程至少有一门跟 张三 所学课程相同的学生信息。
#第4步：最后，根据这些学生id，找出他们的信息
select * from stu where id in (
	 #第3步：根据这些课程id，找出学了这些课程的学生ID
	select stu_id from stu_kecheng where kecheng_id in (
		#第2步，根据其id，找出张三的所学课程的ID
		select kecheng_id from stu_kecheng where id = (
			#第1步：找出张三的id
			select id from stu where name = '张三'
		)
	)
);

#不包含张三的数据
select * from stu where id in (
	 #第3步：根据这些课程id，找出学了这些课程的学生ID
	select stu_id from stu_kecheng where kecheng_id in (
		#第2步，根据其id，找出张三的所学课程的ID
		select kecheng_id from stu_kecheng where id = (
			#第1步：找出张三的id
			select id from stu where name = '张三'
		)
	)
) and not (name = '张三');



8)查询两门及两门以上不及格同学的平均分
#第1步：找出所有不及格的分数信息：
select * from stu_kecheng where score < 60;
第2步：在对该所有不及格的结果数据进行分组，并取得大于等于2的组：
select stu_id from stu_kecheng as ak where score < 60 group by stu_id having count(*) >=2;
第3步：根据这些学生id，找出他们的所有成绩，并进行统计平均分
select stu_id ,name ,avg(score) from stu_kecheng as sk inner join stu on stu.id = sk.stu_id where stu_id in(
	select stu_id from stu_kecheng as ak where score < 60 group by stu_id having count(*) >=2;
)group by stu_id ,name;
目前来说stu_id与name是一样的，就是因为为了整齐，在获取的时候写了name，所以在group by 的时候也写name，因为group过后除了group by字段的时候有效，区域数据都是无效的，脏数据，聚合函数除外

//这句就是核心，获取的是分数小于60，且出现次数大于等于2的学生id
select stu_id from stu_kecheng where score <60 group by stu_id having count(*) >=2;


