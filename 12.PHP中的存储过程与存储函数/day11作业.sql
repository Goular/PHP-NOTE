///////////////////////////////////////////////////////////////
//2���ѯ��
///////////////////////////////////////////////////////////////
1)����������ϵ��������ѧ����Ϣ�� 
select * from ѧ���� where ԺϵID = (
	select ԺϵID from Ժϵ where Ժϵ���� = '�����ϵ'
);#����Ч�ʽϵ�
select * from ѧ���� inner join Ժϵ on ѧ����.ԺϵID = Ժϵ.ԺϵID where Ժϵ���� = "�����ϵ";#����Ч�ʽϸ�

2)�������˳ƽ�����ڵ�Ժϵ��Ϣ��
select * from Ժϵ where ԺϵID = (select ԺϵID from ѧ���� where ѧ�� = '��˳ƽ');#����Ч�ʽϵ�
select * from Ժϵ inner join ѧ���� on ѧ����.ԺϵID = Ժϵ.ԺϵID where ѧ����.ѧ��= '��˳ƽ';#����Ч�ʽϸ�

3)����ڡ�����¥���칫��Ժϵ���ơ�
select Ժϵ���� from Ժϵ where ϵ���ַ like '%����¥%';


4)�������Ů���������ˡ�
select �Ա�,count(*) from ѧ���� group by �Ա�;

5)�����������Ժϵ��Ϣ��(������ص�,��������鿴)
select * from Ժϵ where ԺϵID = (
	/*��ԺϵID�����飬�ҳ�ԺϵID������������Ϊ�����Ǹ�ֵ*/
	select ԺϵID from ѧ���� group by ԺϵID having count(*) = (
		/*�ҳ���ԺϵID����Ľ���У����������Ǹ���ֵ*/
		select count(*) from ѧ���� group by ԺϵID order by count(*) desc limit 0,1
	)
);

//���Ȳ���Ժϵ��Ϣ
select * from Ժϵ where ԺϵID = (
	select ԺϵID from ѧ���� group by ԺϵID having count(*) = (
		select count(*) from ѧ���� group by ԺϵID order by count(*) desc limit 0,1
	)
) ;



6)�����������Ժϵ����Ů���������ˡ�
select �Ա�,count(*) from ѧ���� where ԺϵID = (
	/*��ԺϵID�����飬�ҳ�ԺϵID������������Ϊ�����Ǹ�ֵ*/
	select ԺϵID from ѧ���� group by ԺϵID having count(*) = (
		/*�ҳ���ԺϵID����Ľ���У����������Ǹ���ֵ*/
		select count(*) from ѧ���� group by ԺϵID order by count(*) desc limit 0,1
	)
) group by �Ա�;



7)��������޵ܻ���ͬ����������ˡ�
select * from ѧ���� where ���� = (
	select ���� from ѧ���� where ѧ�� = '�޵ܻ�'
);
//���Ҫ�ų����˱�����
select * from ѧ���� where ���� = (
	select ���� from ѧ���� where ѧ�� = '�޵ܻ�'
) and ѧ�� <> '�޵ܻ�';


8)����С��ӱ����˾Ͷ���Ժϵ��Ϣ��
select * from Ժϵ inner join ѧ���� on Ժϵ.ԺϵID = ѧ����.ԺϵID where ѧ����.���� = '�ӱ�'�� 


9)��������ӱ�Ů����ͬԺϵ������ѧ������Ϣ��
select * from ѧ���� where ԺϵID in(
	select ԺϵID from ѧ���� where ����='�ӱ�' and �Ա� = 'Ů'
);
//���Ҫ�ų����ӱ�Ů����������
select * from ѧ���� where ԺϵID in(
	select ԺϵID from ѧ���� where ����='�ӱ�' and �Ա� = 'Ů'
) and not (���� = '�ӱ�' and �Ա� = 'Ů');

///////////////////////////////////////////////////////////////
//3���ѯ��
//����ѧ����
create table stu (
	id int auto_increment primary key not null,
	name varchar(20),
	gender enum('��','Ů'),
	class_id tinyint
)charset = utf8 ,comment = 'ѧ����';

//�����γ̱�
create table kecheng(
	id int auto_increment primary key not null,
	kecheng_name varchar(20)
)charset = utf8;

//����������
create table stu_kecheng(
	id int auto_increment primary key not null,
	stu_id int ,
	kecheng_id int,
	score int
);


///////////////////////////////////////////////////////////////
1)��ѯѡ���� MySQL ��ѧ��������
select * from stu inner join kecheng on kecheng.id = stu.class_id where kecheng.kecheng_name = 'MySQL';
select * from stu where class_id = (
	select id from kecheng where kecheng_name = 'MySQL'
);

2)��ѯ ���� ͬѧѡ���˵Ŀγ����֣�
select kecheng.kecheng_name from kecheng inner join stu on stu.class_id = kecheng.id where stu.name = '����';
select kecheng_name from kecheng where id = (
	select class_id  from stu where name = '����'
);

3)��ѯֻѡ����1�ſγ̵�ѧ��ѧ�ź�������
select * from stu where id in(
	select stu_id from stu_kecheng group by stu_id having count(*)= 1
);

4)��ѯѡ��������3�ſγ̵�ѧ����Ϣ��
select * from stu where id in (
	select stu_id from stu_kecheng group by stu_id having count(*) >=3
);


5)��ѯѡ�������пγ̵�ѧ����
select * from stu where id in (
	select stu_id from stu_kecheng group by stu_id having count(*) = (
		select count(*) from kecheng
	)
);

6)��ѯѡ���˿γ̵���������
//��һ������stu_idΪ�������з��飬�ҳ�����ѡ���˿γ̵�ѧ��id
select stu_id from stu_kecheng group by stu_id;
//��2���������������Ϊ������Դ����ͳ��������������ѡ���˿γ̵�ѧ��������
select count(*) from (select stu_id from stu_kecheng group by stu_id) as t;


7)��ѯ��ѧ�γ�������һ�Ÿ� ���� ��ѧ�γ���ͬ��ѧ����Ϣ��
#��4������󣬸�����Щѧ��id���ҳ����ǵ���Ϣ
select * from stu where id in (
	 #��3����������Щ�γ�id���ҳ�ѧ����Щ�γ̵�ѧ��ID
	select stu_id from stu_kecheng where kecheng_id in (
		#��2����������id���ҳ���������ѧ�γ̵�ID
		select kecheng_id from stu_kecheng where id = (
			#��1�����ҳ�������id
			select id from stu where name = '����'
		)
	)
);

#����������������
select * from stu where id in (
	 #��3����������Щ�γ�id���ҳ�ѧ����Щ�γ̵�ѧ��ID
	select stu_id from stu_kecheng where kecheng_id in (
		#��2����������id���ҳ���������ѧ�γ̵�ID
		select kecheng_id from stu_kecheng where id = (
			#��1�����ҳ�������id
			select id from stu where name = '����'
		)
	)
) and not (name = '����');



8)��ѯ���ż��������ϲ�����ͬѧ��ƽ����
#��1�����ҳ����в�����ķ�����Ϣ��
select * from stu_kecheng where score < 60;
��2�����ڶԸ����в�����Ľ�����ݽ��з��飬��ȡ�ô��ڵ���2���飺
select stu_id from stu_kecheng as ak where score < 60 group by stu_id having count(*) >=2;
��3����������Щѧ��id���ҳ����ǵ����гɼ���������ͳ��ƽ����
select stu_id ,name ,avg(score) from stu_kecheng as sk inner join stu on stu.id = sk.stu_id where stu_id in(
	select stu_id from stu_kecheng as ak where score < 60 group by stu_id having count(*) >=2;
)group by stu_id ,name;
Ŀǰ��˵stu_id��name��һ���ģ�������ΪΪ�����룬�ڻ�ȡ��ʱ��д��name��������group by ��ʱ��Ҳдname����Ϊgroup�������group by�ֶε�ʱ����Ч���������ݶ�����Ч�ģ������ݣ��ۺϺ�������

//�����Ǻ��ģ���ȡ���Ƿ���С��60���ҳ��ִ������ڵ���2��ѧ��id
select stu_id from stu_kecheng where score <60 group by stu_id having count(*) >=2;


