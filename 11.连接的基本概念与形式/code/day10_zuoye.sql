�������һ����Ʒ����Ʒ��Ϣ��
select * from product order by price desc limit 0,1;

������(����)����Ʒ�ı�ţ�ID���� 
select pro_id from product order by pro_id desc limit 0,1;

����������Ʒ�ļ۸�
select price as �������Ʒ�۸� from product order by price asc limit 0,1;

ȡ����С(���)����Ʒ��š�
select pro_id as ��С����Ʒ��� from product order by pro_id asc limit 0,1;

���������Ʒ����������
select count(*) as ��Ʒ������ from product ;

���������Ʒ��ƽ���۸�
select avg(price) as ��Ʒ��ƽ���۸� from product ;

�������Ʒ�Ƶ�������Ʒ��ƽ���۸�
select avg(price) as ����Ʒ����Ʒƽ���۸� from product where pinpai = '����';

���۸��ɸߵ�������
select price from product order by price desc;

����Ʒ�����ɵ͵������������ڲ����۸��ɸߵ�������
select * from product order by protype_id asc ,price desc; 

ȡ���۸���ߵ�ǰ������Ʒ��
select * from product order by price limit 0,3;

���ÿ�����ظ��ж�����������Ʒ
select  chandi as ���� , count(*) from product group by chandi desc;

���ÿ��Ʒ�ָ��ж��ٸ���Ʒ
select protype_id as Ʒ��id , count(*) from product group by protype_id;

