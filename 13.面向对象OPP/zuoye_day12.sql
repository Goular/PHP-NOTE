--首先是需要做一点预处理
delimiter ;;

--这样做的原因是存储过程的编写其实是代码的编写，代码的分隔与执行的分隔符一样，此时就不能做代码的编写了，所以在CMD下必须使用delimiter来重新定义CMD下的语句分隔符


--存储过程与函数其实都是保存代码逻辑的容器，但是函数是必须带返回值，而存储过程是不带返回值（但提供更为强大的in/out/inout的参数结合体）
--1，创建一个存储过程，带3个参数，调用该存储过程，可以将此3个参数作为数据写入的某个表中。
create procedure pro11(in p1 int ,in p2 tinyint ,in p3 int)
begin
	insert into tab_int(f1,f2,f3) values (p1,p2,p3);
end;

call pro11(132,32,456);

2，创建一个存储函数，带3个参数，调用该存储函数，可以将此3个参数作为数据写入的某个表中。
create function fun11(p1 int,p2 tinyint,p3 int)
returns int
begin
	insert into tab_int(f1,f2,f3) values (p1,p2,p3);
	return 1;
end;

--函数的使用场景1
select fun11(333,44,555) as f1;; --当自查询作为数据源的时候必须添加别名，否则会报错
--函数的使用场景2
select * from stu where id = func11(222,44, 111);; --运行后其实走的是：select * from stu where id = 1;;
