## �����̳ǵ�����
###
<pre> �޸�����
	ȡ��Ʒʱ����ȡ��Ʒ�����ơ�* �������������Ŀ�Ļ�����һ��Ҫ�������գ�����������
	�޸���Ʒģ���е�search������ȡ���ݵĴ���
</pre>

### ��չ������������������
<pre>
	������

	�ص㣺���������һ����ȡ������������û�й��������ݡ�
	����LEFT JOIN����ָ��ߵı�������
	
	������
	�ص㣺���ѯ���������й���������
</pre>

### ����������������ĸ����Сд��������Ե��ʿ��Դ�д

### MySQL�Դ����
<pre>
	��չ����β�ʹ�ô���ɾ������ɾ����Ʒʱ��Ա�۸���еļ�¼�Զ���ɾ����
	����ʹ��MYSQL���Դ����Լ����ʵ�֡�ǰ�᣺ֻ��InnoDB����֧�֡�
	
	foreignkey key (goods_id) references p39_goods(id) on delete cascade;
</pre>

### �ϴ��ı���ʱ��ִ��ʱ�����
<pre>
	�ű�ִ��ʱ�䡾Ĭ��PHPһ���ű�ֻ��ִ��30�롿
	�������ϴ�ͼƬ֮ǰ����
	
	��ִ��ǰ�����������:
	set_time_limit(0);
</pre>

### ��չ��PHP�е�U����
<pre>
	php�еĴ�U��������������
		U('ajaxDelPic')                    ==>   /index.php/Admin/Goods/ajaxDelPic.html
		U('ajaxDelPic?id=1')                  ==>   /index.php/Admin/Goods/ajaxDelPic/id/1.html
		U('ajaxDelPic', array('id'=>1))      ==>   /index.php/Admin/Goods/ajaxDelPic/id/1.html
		U('ajaxDelPic', array('id'=>1), FALSE)      ==>   /index.php/Admin/Goods/ajaxDelPic/id/1
</pre>

### �����Ҫ����ı��������Ǳ�ǩû��λ�ÿ��Է��ã���ʱ�����Զ������ԣ�ʹ��Jquery��attr�������ɻ�ȡ��������.
<pre>

</pre>

###
<pre>

</pre>

###
<pre>

</pre>

###
<pre>

</pre>

###
<pre>

</pre>

###
<pre>

</pre>