--��������Ҫ��һ��Ԥ����
delimiter ;;

--��������ԭ���Ǵ洢���̵ı�д��ʵ�Ǵ���ı�д������ķָ���ִ�еķָ���һ������ʱ�Ͳ���������ı�д�ˣ�������CMD�±���ʹ��delimiter�����¶���CMD�µ����ָ���


--�洢�����뺯����ʵ���Ǳ�������߼������������Ǻ����Ǳ��������ֵ�����洢�����ǲ�������ֵ�����ṩ��Ϊǿ���in/out/inout�Ĳ�������壩
--1������һ���洢���̣���3�����������øô洢���̣����Խ���3��������Ϊ����д���ĳ�����С�
create procedure pro11(in p1 int ,in p2 tinyint ,in p3 int)
begin
	insert into tab_int(f1,f2,f3) values (p1,p2,p3);
end;

call pro11(132,32,456);

2������һ���洢��������3�����������øô洢���������Խ���3��������Ϊ����д���ĳ�����С�
create function fun11(p1 int,p2 tinyint,p3 int)
returns int
begin
	insert into tab_int(f1,f2,f3) values (p1,p2,p3);
	return 1;
end;

--������ʹ�ó���1
select fun11(333,44,555) as f1;; --���Բ�ѯ��Ϊ����Դ��ʱ�������ӱ���������ᱨ��
--������ʹ�ó���2
select * from stu where id = func11(222,44, 111);; --���к���ʵ�ߵ��ǣ�select * from stu where id = 1;;
