jbMap = window.jbMap || {};
function jbViaJs(locationId) {
    var _f = undefined;
    var _fconv = 'jbMap[\"' + locationId + '\"]';
    try {
        _f = eval(_fconv);
        if (_f != undefined) {
            _f()
        }
    } catch(e) {}
}
function jbLoader(closetag) {
    var jbTest = null,
    jbTestPos = document.getElementsByTagName("span");
    for (var i = 0; i < jbTestPos.length; i++) {
        if (jbTestPos[i].className == "jbTestPos") {
            jbTest = jbTestPos[i];
            break
        }
    }
    if (jbTest == null) return;
    if (!closetag) {
        document.write("<span id=jbTestPos_" + jbTest.id + " style=display:none>");
        jbViaJs(jbTest.id);
        return
    }
    document.write("</span>");
    var real = document.getElementById("jbTestPos_" + jbTest.id);
    for (var i = 0; i < real.childNodes.length; i++) {
        var node = real.childNodes[i];
        if (node.tagName == "SCRIPT" && /closetag/.test(node.className)) continue;
        jbTest.parentNode.insertBefore(node, jbTest);
        i--
    }
    jbTest.parentNode.removeChild(jbTest);
    real.parentNode.removeChild(real)
}

var logo_m='<a href="http://vps.zzidc.com/tongji/jb51.html" target="_blank"><img src="http://files.jb51.net/image/zzidc370.gif" width=370 height=60 /></a>';
var logo_r='<a href="http://www.jisuapp.cn/index.php?r=pc/Webapp/AppTpl" target="_blank"><img src="http://files.jb51.net/image/jisuapp370.jpg" width=370 height=60 /></a>';

var aliyun1000='<div class="mainlr"><a href="http://click.aliyun.com/m/22821/" target="_blank"><img src="http://files.jb51.net/image/ali1000.jpg" alt="cdnoss" width="1000" height="60"></a></div><div class="blank5"></div>';
var aliyun10002='<div class="mainlr"><a href="https://cloud.tencent.com/developer/labs?fromSource=gwzcw.267034.267034.267034" target="_blank"><img src="http://files.jb51.net/image/tengxunyun.gif" alt="mtyun" width="1000" height="60"></a></div><div class="blank5"></div>';
aliyun10002+='<div class="mainlr"><a href="http://edu.51cto.com/activity/lists/id-50.html?qd=jiao" target="_blank"><img src="http://files.jb51.net/image/51cto.png" alt="mtyun" width="1000" height="60"></a></div><div class="blank5"></div>';

var idctu="";
idctu+='<scr'+'ipt async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></scr'+'ipt><!--thea+300*250--><ins class="adsbygoogle"style="display:inline-block;width:300px;height:250px"data-ad-client="ca-pub-6389290466807248"data-ad-slot="6788945816"></ins><scr'+'ipt>(adsbygoogle=window.adsbygoogle||[]).push({});</scr'+'ipt><div class="blank10"></div>';
idctu+='<A href="http://click.aliyun.com/m/21950/" target=_blank><IMG alt="" src="http://files.jb51.net/image/ali_300_1.jpg" width="300" height="100"></A><div class="blank10"></div>';

var aliwenzi='<li><a href="http://click.aliyun.com/m/15321/" target="_blank"><span style="color:red;">30�����Ʋ�Ʒ���6����>></span></a></li>';
var ali237='<li><A href="http://click.aliyun.com/m/21949/" target=_blank><IMG alt="" src="http://files.jb51.net/image/ali_237_1.jpg" width="237" height="60"></A></li>';

var tgtxt="";
tgtxt+='<div id="txtlink"><ul>';
tgtxt+='<li><a href="http://www.qqll.me" target="_blank"><span style="color:red;">�ͼ۳�������10000IPֻ��8Ԫ</span></a></li>';
tgtxt+=aliwenzi;
tgtxt+='<li><a href="http://user.liuliangdada.com/" target="_blank"><span style="color:red;">�չ�����IP��2��UV��5Ԫ/�򡢿ɵ��</span></a></li>';
tgtxt+='<li><a href="http://www.zoneidc.com/" target="_blank"><span style="color:red;">1G�����49Ԫ/������49Ԫ/������89Ԫ</span></a></li>';

tgtxt+='<li><a href="https://s.jb51.net" target="_blank"><span style="color:blue;">����������������ء����ű�֮��</span></a></li>';
tgtxt+='<li><a href="http://www.xmwzidc.com" target="_blank"><span style="color:blue;">��������������ȫ����������á�����</span></a></li>';
tgtxt+='<li><a href="http://www.daniu.net/" target="_blank"><span style="color:blue;">��������ⶨλ�������׿ƻ���������á�</span></a></li>';
tgtxt+='<li><a href="http://www.zitian.cn/Products/zhongyuan/overview.aspx" target="_blank"><span style="color:blue;">��ԭ���������������ģ������й����</span></a></li>';

tgtxt+='<li><a href="http://www.laoyuming.com" target="_blank"><span style="color:red;">��3000��������������100Ԫ�� ÿ�����</span></a></li>';
tgtxt+='<li><a href="http://www.2016idc.com/cdn.html" target="_blank"><span style="color:red;">�����������߷��ⱸ��CDN����������</span></a></li>';
tgtxt+='<li><a href="http://www.enkj.com/special/20160315/" target="_blank"><span style="color:red;">BGP���� �ڶ�1U�������й�3999Ԫ/��</span></a></li>';
tgtxt+='<li><A href="http://www.jjidc.com/" target=_blank><span style="color:red;">�ž����� �� ���Ų��Ͽ���������IDC������</span></A></li>';

tgtxt+='<li><a href="http://www.oo.ht/s/?wd=php+jquery" target="_blank"><span style="color:blue;">OO����PHP PYTHON JQUERY�����¼��վ</span></a></li>';
tgtxt+='<li><a href="http://www.ku86.com/" target="_blank"><span style="color:blue;">���� 12��24�߳� 16G�ڴ� 2T 999/��</span></a></li>';
tgtxt+='<li><a href="http://www.021.net" target="_blank"><span style="color:blue;">�������� �����Ƽ���Ļ���������������Ӫ��</span></a></li>';
tgtxt+='<li><a href="http://b.99-idc.com/bohaovps.asp?typeid=3000" target="_blank"><span style="color:blue;">�κ�VPS/ȫ�����VPS/�κŷ�����-��������</span></a></li>';

tgtxt+='<li><a href="http://www.33ip.com" target="_blank"><span style="color:red;">���ſƼ�-����˫��10M��֤-399/Ԫ</span></a></li>';
tgtxt+='<li><a href="http://www.gwidc.com/html/server_zy_xz.asp" target="_blank"><span style="color:red;">��������-���ݰٶ�16��32G 999/��~</span></a></li>';
tgtxt+='<li><a href="http://www.ssf.cc/" target="_blank"><span style="color:red;">�ⱸvps20/�ٶ�799/˫��350/45����</span></a></li>';
tgtxt+='<li><a href="http://www.xiaozhiyun.com/2016/" target="_blank"><span style="color:red;">����\���\����վȺ������ ��ţ����</span></a></li>';

tgtxt+='<li><a href="http://www.139w.com/" target="_blank"><span style="color:blue;">����������׶������������999Ԫ</span></a></li>';
tgtxt+='<li><a href="http://www.360jq.com/hkshuang.htm" target="_blank"><span style="color:blue;">[���˫�߷�]����CC��DDOS/���ȹ㶫��</span></a></li>';
tgtxt+='<li><a href="http://www.cyidc.cc/" target="_blank"><span style="color:blue;">�������� �ٶ������� ������ 998Ԫ</span></a></li>';
tgtxt+='<li><a href="http://www.wdw6.com" target="_blank"><span style="color:blue;">����������  199Ԫ��</span></a></li>';

tgtxt+='<li><a href="http://www.wsisp.net/sale/20170518/?indexjb" target="_blank"><span style="color:red;">���~�}5M����������599/��}�~��</span></a></li>';
tgtxt+='<li><a href="http://www.qy.com.cn" target="_blank"><span style="color:red;">ȺӢ�Ʒ�������10M����30G����,49Ԫ��</span></a></li>';
tgtxt+='<li><a href="http://www.tuidc.com" target="_blank"><span style="color:red;">����������/�й�-�����ռ�/��׼���ӿƼ�</span></a></li>';
tgtxt+='<li><a href="https://www.zllyun.com" target="_blank"><span style="color:red;">�}�~�������������������1/�� �}�~��</span></a></li>';
tgtxt+='</ul><DIV class=clearfix></DIV></div>';

var tonglan1="";
tonglan1+=aliyun1000;
tonglan1+=tgtxt;
tonglan1+='<div class="blank6"></div>';
tonglan1+='<div class="topimg"><ul>';
tonglan1+='<li><A href="http://www.west.cn/services/CloudHost/?ads=jb512014" target=_blank><IMG alt="" src="http://files.jb51.net/image/west263_237.gif" width="237" height="60"></A></li>';
tonglan1+=ali237;
tonglan1+='<li><A href="http://www.xinghai365.com/new/cloud/cloud.asp" target=_blank><IMG alt="" src="http://files.jb51.net/image/xinghaivps.gif" width="237" height="60"></A></li>';
tonglan1+='<li><A href="http://www.8dwww.com/product/list/11754.html" target=_blank><IMG alt="" src="http://files.jb51.net/image/7ehk.gif" width="237" height="60"></A></li>';
tonglan1+='</ul></div><div class="blank6"></div>';
tonglan1+=aliyun10002;

var tonglan1_2="";
tonglan1_2+=aliyun1000;
tonglan1_2+=tgtxt;
tonglan1_2+='<div class="blank6"></div>';
tonglan1_2+='<div class="topimg"><ul>';
tonglan1_2+='<li><A href="http://www.8dwww.com/product/list/11754.html" target=_blank><IMG alt="" src="http://files.jb51.net/image/7ehk.gif" width="237" height="60"></A></li>';
tonglan1_2+='<li><A href="https://www.wsisp.net/sale/20170110/?jb51" target=_blank><IMG alt="" src="http://files.jb51.net/image/ws_237.gif" width="237" height="60"></A></li>';
tonglan1_2+=ali237;
tonglan1_2+='<li><A href="http://www.xinghai365.com/new/cloud/cloud.asp" target=_blank><IMG alt="" src="http://files.jb51.net/image/xinghaivps.gif" width="237" height="60"></A></li>';
tonglan1_2+='</ul></div><div class="blank6"></div>';
tonglan1_2+=aliyun10002;

var tonglan2='<a href="http://www.v01.cn" alt="�Ϻ�����" target="_blank"><img src="http://files.jb51.net/image/zs960.gif" width="1000" height="60" border="0" /></a><div class="blank3"></div><a href="http://tuidc.com" alt="������� ��������" target="_blank"><img src="http://files.jb51.net/image/host5_960.gif" width="1000" height="60" border="0" /></a>';
var tonglan2_1='<a href="http://www.v01.cn" alt="�Ϻ�����" target="_blank"><img src="http://files.jb51.net/image/zs960.gif" width="1000" height="60" border="0" /></a>';
var tonglan2_2='<a href="http://www.tuidc.com" alt="����" target="_blank"><img src="http://files.jb51.net/image/tuidc_1000.gif" width="1000" height="60" border="0" /></a>';

var tonglan3_1='<div class="mainlr"><a href="http://www.qy.com.cn" target="_blank"><img src="http://files.jb51.net/image/qy_1000.gif" width="1000" height="60"></a></div><div class="blank5"></div>';

var tonglan3_2='<div class="topimg"><ul>';
tonglan3_2+='<li><A href="http://www.west.cn/?ads=jb512012" target=_blank><IMG alt="" src="http://files.jb51.net/image/west263_index.gif" width="237" height="60"></A></li>';
tonglan3_2+='<li><A href="http://www.jjidc.com" target=_blank><IMG alt="" src="http://files.jb51.net/image/jjidc_237.gif" width="237" height="60"></A></li>';
tonglan3_2+='<li><A href="http://www.enkj.com/encloud/" target=_blank><IMG alt="" src="http://files.jb51.net/image/enkj_237.gif" alt="�Ʒ�����" width="237" height="60"></A></li>';
tonglan3_2+='<li><A href="http://www.cyidc.cc/" target=_blank><IMG alt="" src="http://files.jb51.net/image/cyidc_237.gif" width="237" height="60"></A></li>';
tonglan3_2+='</ul></div>';

var botad='<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
botad+='<ins class="adsbygoogle" style="display:inline-block;width:336px;height:280px" data-ad-client="ca-pub-6384567588307613" data-ad-slot="6445926239" data-override-format="true" data-page-url="http://www.jb51.net"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';

var idctu1='<div class="idc3"><a href="http://www.021.net" target="_blank"><h1>��������</h1><span>Ʒ�Ʒ���������</span> </a><a href="http://www.geisnic.com/" target="_blank"><h1>��˼����</h1><span>VPS����</span> </a><a href="http://www.33ip.com" target="_blank"><h1>���ſƼ�</h1><span>IDC������</span> </a></div>';

var idctu2='<a href="http://tuidc.com" target="_blank"><img src="http://files.jb51.net/image/tengyou300.gif" width="300" height="100"></a>';
idctu2+='<div class="blank10"></div><a href="http://www.enkj.com/encloud/" target="_blank"><img src="http://files.jb51.net/image/enkj_300.gif" alt="�Ʒ�����" width="300" height="100"></a>';
/*******---------���߹���start----------********/
var toolsarr= new Array();
toolsarr[0]=new Array();
toolsarr[0][name]="����XML/JSON����ת������";
toolsarr[0]['link']="http://tools.jb51.net/code/xmljson";

toolsarr[1]=new Array();
toolsarr[1][name]="CSS���빤��";
toolsarr[1]['link']="http://tools.jb51.net/code/css";

toolsarr[2]=new Array();
toolsarr[2][name]="JSON���빤��";
toolsarr[2]['link']="http://tools.jb51.net/code/json";

toolsarr[3]=new Array();
toolsarr[3][name]="JavaScript�����ʽ������";
toolsarr[3]['link']="http://tools.jb51.net/code/js";

toolsarr[4]=new Array();
toolsarr[4][name]="JavaScript�������߼��ܹ���";
toolsarr[4]['link']="http://tools.jb51.net/code/encodeTxt";

toolsarr[5]=new Array();
toolsarr[5][name]="JavaScriptѹ��/��ʽ��/���ܹ���";
toolsarr[5]['link']="http://tools.jb51.net/code/jscompress";

toolsarr[6]=new Array();
toolsarr[6][name]="����JSON�������/����/����/��ʽ��";
toolsarr[6]['link']="http://tools.jb51.net/code/json";

toolsarr[7]=new Array();
toolsarr[7][name]="JavaScript�������߲��Թ���";
toolsarr[7]['link']="http://tools.jb51.net/regex/javascript";

toolsarr[8]=new Array();
toolsarr[8][name]="Unixʱ���(timestamp)ת������";
toolsarr[8]['link']="http://tools.jb51.net/code/unixtime";

toolsarr[9]=new Array();
toolsarr[9][name]="����JS�ű�У��������";
toolsarr[9]['link']="http://www.jb51.net/tools/js_Debug.htm";

toolsarr[10]=new Array();
toolsarr[10][name]="�������ɶ�ά�빤��(��ǿ��)";
toolsarr[10]['link']="http://tools.jb51.net/transcoding/jb51qrcode";

toolsarr[11]=new Array();
toolsarr[11][name]="����XML��ʽ��/ѹ������";
toolsarr[11]['link']="http://tools.jb51.net/code/xmlformat";

toolsarr[12]=new Array();
toolsarr[12][name]="php�������߸�ʽ����������";
toolsarr[12]['link']="http://tools.jb51.net/code/phpformat";

toolsarr[13]=new Array();
toolsarr[13][name]="sql�������߸�ʽ����������";
toolsarr[13]['link']="http://tools.jb51.net/code/sqlcodeformat";

toolsarr[14]=new Array();
toolsarr[14][name]="RGB��ɫ��ѯ���ձ�_��ɫ����";
toolsarr[14]['link']="http://tools.jb51.net/color/jPicker";

toolsarr[15]=new Array();
toolsarr[15][name]="����HTMLת��/��ת�幤��";
toolsarr[15]['link']="http://tools.jb51.net/transcoding/html_transcode";

toolsarr[16]=new Array();
toolsarr[16][name]="������ʽ�������ɹ���";
toolsarr[16]['link']="http://tools.jb51.net/regex/create_reg";

toolsarr=getArrayItems(toolsarr,11);

var bctools='<li><a href="'+toolsarr[0]['link']+'" target="_blank"><font color="red">'+toolsarr[0][name]+'</font></a></li>';
bctools+='<li><a href="'+toolsarr[1]['link']+'" target="_blank"><font color="red">'+toolsarr[1][name]+'</font></a></li>';
bctools+='<li><a href="'+toolsarr[2]['link']+'" target="_blank">'+toolsarr[2][name]+'</a></li>';
bctools+='<li><a href="'+toolsarr[3]['link']+'" target="_blank"><font color="red">'+toolsarr[3][name]+'</font></a></li>';
bctools+='<li><a href="'+toolsarr[4]['link']+'" target="_blank">'+toolsarr[4][name]+'</a></li>';
bctools+='<li><a href="'+toolsarr[5]['link']+'" target="_blank">'+toolsarr[5][name]+'</a></li>';
bctools+='<li><a href="'+toolsarr[6]['link']+'" target="_blank">'+toolsarr[6][name]+'</a></li>';
bctools+='<li><a href="'+toolsarr[7]['link']+'" target="_blank">'+toolsarr[7][name]+'</a></li>';
bctools+='<li><a href="'+toolsarr[8]['link']+'" target="_blank">'+toolsarr[8][name]+'</a></li>';
bctools+='<li><a href="'+toolsarr[9]['link']+'" target="_blank">'+toolsarr[9][name]+'</a></li>';
/*******---------���߹���end----------********/


//u336546
var tonglanbd='<scr'+'ipt type="text/javascript" src="http://dm.jb51.net/cmds5flr1.js"></scr'+'ipt>';

var art_up = '<scri'+'pt type="text/javascript" src="http://dm.jb51.net/gn3a1ecf96f1ccff30db1c7481b2b03ded00b3930a3ef6.js"></s'+'cript>';

//u3025827(u776243)
var art_down = '<scr'+'ipt type="text/javascript" src="http://dm.jb51.net/z8dje9abx1.js"></scr'+'ipt>';

var art_down2 = '<scrip'+'t type="text/javascript" src="http://dm.jb51.net/tb3a1ecf96f1cdf739db1c7481b2b03ded00b3930a3ef6.js"></s'+'cript>';

var side_up = '<scri'+'pt async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></scri'+'pt>';
side_up+='<ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-6384567588307613" data-ad-slot="2817964327"></ins><scri'+'pt>(adsbygoogle = window.adsbygoogle || []).push({});</s'+'cript>';

var r_2 = '<script type="text/javascript">var cpro_id="u1397867";(window["cproStyleApi"] = window["cproStyleApi"] || {})[cpro_id]={at:"3",rsi0:"300",rsi1:"380",pat:"6",tn:"baiduCustNativeAD",rss1:"#FFFFFF",conBW:"1",adp:"1",ptt:"0",titFF:"%E5%BE%AE%E8%BD%AF%E9%9B%85%E9%BB%91",titFS:"14",rss2:"#000000",titSU:"0",ptbg:"90",piw:"0",pih:"0",ptp:"0"}</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>';

var fudong = '<scri'+'pt type="text/javascript">var cpro_id="u1397867";(window["cproStyleApi"] = window["cproStyleApi"] || {})[cpro_id]={at:"3",rsi0:"300",rsi1:"380",pat:"6",tn:"baiduCustNativeAD",rss1:"#FFFFFF",conBW:"1",adp:"1",ptt:"0",titFF:"%E5%BE%AE%E8%BD%AF%E9%9B%85%E9%BB%91",titFS:"14",rss2:"#000000",titSU:"0",ptbg:"90",piw:"0",pih:"0",ptp:"0"}</sc'+'ript>';
fudong += '<scrip'+'t src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></scr'+'ipt>';

var gg_l = '<scri'+'pt async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></scri'+'pt>';
gg_l += '<ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-6384567588307613" data-ad-slot="6438537127"></ins>';
gg_l += '<scri'+'pt>(adsbygoogle = window.adsbygoogle || []).push({});</s'+'cript>';

//u811641
var gg_r = '<scri'+'pt type="text/javascript" src="http://dm.jb51.net/zrdndac71.js"></sc'+'ript>';

var r1gg='<scri'+'pt async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></scri'+'pt>';
r1gg+='<ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-6384567588307613" data-ad-slot="2817964327"></ins><scri'+'pt>(adsbygoogle = window.adsbygoogle || []).push({});</s'+'cript>';
/*
var r1gg = '<scri'+'pt async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></scri'+'pt><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-1247620132145618" data-ad-slot="2253650178" data-override-format="true" data-page-url="http://www.jb51.net"></ins><scri'+'pt>(adsbygoogle = window.adsbygoogle || []).push({});</s'+'cript>';
*/
//u2261513
//var bd200 = '<scri'+'pt type="text/javascript" src="http://dm.jb51.net/hod9xqa8sj.js"></sc'+'ript>';

var bd200 = '<scri'+'pt type="text/javascript">var cpro_id="u2261513";(window["cproStyleApi"] = window["cproStyleApi"] || {})[cpro_id]={at:"3",rsi0:"300",rsi1:"300",pat:"6",tn:"baiduCustNativeAD",rss1:"#FFFFFF",conBW:"1",adp:"1",ptt:"0",titFF:"%E5%BE%AE%E8%BD%AF%E9%9B%85%E9%BB%91",titFS:"14",rss2:"#000000",titSU:"0",ptbg:"90",piw:"0",pih:"0",ptp:"0"}</sc'+'ript>';
bd200 += '<scrip'+'t src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></scr'+'ipt>';

var dxy728 = '<a href="http://www.33ip.com" target="_blank"><img src="http://files.jb51.net/image/33ip_728.gif"></a>';
var dxy230 = '<a href="http://edu.jb51.net/" target="_blank"><img src="http://files.jb51.net/image/edu230.png" width=260 height=90></a>';

var qq_index = '<script type="text/javascript">var cpro_id="u1424765";</script>';
qq_index += '<scri'+'pt src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></sc'+'ript>';

jbMap['logo_m'] = function() {
	document.writeln(logo_m);
};

jbMap['logo_r'] = function() {
	document.writeln(logo_r);
};

jbMap['idctu'] = function() {
	document.writeln(idctu);
};

jbMap['tonglanbd'] = function() {
	document.writeln(tonglanbd);
};

jbMap['tonglan1'] = function() {
	document.writeln(tonglan1);
};

jbMap['tonglan1_2'] = function() {
	document.writeln(tonglan1_2);
};

jbMap['tonglan2'] = function() {
	document.writeln(tonglan2);
};

jbMap['tonglan2_1'] = function() {
	document.writeln(tonglan2_1);
};

jbMap['tonglan2_2'] = function() {
	document.writeln(tonglan2_2);
};

jbMap['tonglan3_1'] = function() {
	document.writeln(tonglan3_1);
};

jbMap['tonglan3_2'] = function() {
	document.writeln(tonglan3_2);
};

jbMap['botad'] = function() {
	document.writeln(botad);
};

jbMap['idctu1'] = function() {
	document.writeln(idctu1);
};

jbMap['idctu2'] = function() {
	document.writeln(idctu2);
};


jbMap['art_up'] = function() {
	document.writeln(art_up);
};

jbMap['art_down'] = function() {
	document.writeln(art_down);
};

jbMap['art_down2'] = function() {
	document.writeln(art_down2);
};

jbMap['side_up'] = function() {
	document.writeln(side_up);
};

jbMap['r_2'] = function() {
	document.writeln(r_2);
};

jbMap['fudong'] = function() {
	document.writeln(fudong);
};


jbMap['gg_l'] = function() {
	document.writeln(gg_l);
};

jbMap['gg_r'] = function() {
	document.writeln(gg_r);
};

jbMap['r1gg'] = function() {
	document.writeln(r1gg);
};

jbMap['bd200'] = function() {
	document.writeln(bd200);
};


jbMap['bctools'] = function() {
	document.writeln(bctools);
};

jbMap['dxy728'] = function() {
	document.writeln(dxy728);
};

jbMap['dxy230'] = function() {
	document.writeln(dxy230);
};

jbMap['qq_index'] = function() {
	document.writeln(qq_index);
};

if (jQuery) { 
$jb51_top = $('#jb51_topbar');
if($jb51_top){
    $jb51_top.html('<div class="userbar"><a href="http://tougao.jb51.net" target="_blank">Ͷ������</a><img style="width:32px; height:22px" src="http://img.jb51.net/skin/2016/images/newn.gif" alt="hot"></div>');
}

$addnav = $('.watch');
if($addnav){
    $addnav.before('<li><div class="one"><a href="http://wxbj.jb51.net" target="_blank">΢�ű༭��</a></div></li>');
	$(".watch .one a").attr("href","http://www.jb51.net/about.htm");
}

if ("undefined" != typeof ourl) {
    if (ourl) {
        $content = $('#content');
        if($content){
			if(ourl.indexOf(":") > 0 ){
            $content.append('<p>ԭ�����ӣ�' + ourl +'</p>');
			}else{
			$content.append('<p>ԭ�����ӣ�' + base64decode(ourl) +'</p>');
			}
        }
    }
}
/*
var shequlink = '<div class="morejb51"><fieldset><legend><div class="wxqq-bg">����������ɨ��������·�ʽ����������</div></legend><table style="border:none;"><tbody><tr><td style="border:none;"><img src="http://files.jb51.net/images/erweima/gongzhonghao.png"></td><td style="border:none;"><a href="http://shequ.jb51.net" target="_blank"><img src="http://files.jb51.net/images/erweima/shequ.png"></a></td><td style="border:none;"><a href="http://youhui.jb51.net" target="_blank"><img src="http://files.jb51.net/images/erweima/youhuiquan.png"></a></td></tr><tr><td style="border:none;">�ű�֮��΢�Ź��ں�</td><td style="border:none;"><a href="http://shequ.jb51.net" target="_blank">�ű�֮��֪ʶ����</a></td><td style="border:none;"><a href="http://youhui.jb51.net" target="_blank">��è�Ա��ڲ��Ż�ȯ</a></td></tr></tbody></table></fieldset></div>'
$content = $('#content');
        if($content){
            $content.append(shequlink);
        }
*/

/*pingmianad
var pathName = window.document.location.pathname;
var projectName = pathName.substring(1, pathName.substr(1).indexOf('/') + 1);
var ad_projectlist = ',,pingmian,photoshop,sheying,Fireworks,CorelDraw,Illustrator,painter,freehand,Indesign,media,,';
if(ad_projectlist.indexOf(','+projectName+',')>0){
    $subnav = $(".main.mb10.clearfix,.tonglanad.clearfix");
	if($subnav){
			$subnav.append('<div class="mainlr"><a href="http://588ku.com/?hd=68588ku.com/?hd=68" target="_blank"><img src="http://files.jb51.net/image/588ku1000.jpg" alt="588ku" width="1000" height="80"></a></div><div class="blank5"></div>');
	}       
}
*/
/*dianshangad*/
var pathName1 = window.document.location.pathname;
var projectName1 = pathName1.substring(1, pathName1.substr(1).indexOf('/') + 1);
var ad_projectlist1 = ',,dianshang,,';
if(ad_projectlist1.indexOf(','+projectName1+',')>0){
    $content = $("#content");
	if($content){
			$content.prepend('<p class="content-lead">2017����Ա�������ƽ̨���ṩ�Ա�ֱ����ͨ���Ա����ꡢֱͨ����ѵ���Ա��ͼ�ְ�ȸ��ַ�����ʮ�������ְ�̼һ�Ա�Ƽ������<strong>QQ/΢�ţ�79883025</strong></p>');
	}       
}else{
    var shequlink = '<p class="content-shequ">��Ա��������ʣ����ύ����������������������ѻ�Ϊ���𣡣�  <a href="http://shequ.jb51.net" target="_blank">�����������</a></p>'
    $content = $('#content');
        if($content){
            $content.append(shequlink);
        }	
}

var gotopcode = " \
  <div class=\"gotop hide\" id=\"gotop\">\
   <a href=\"javascript:;\" class=\"jb51-weixin\"></a>\
  <div class=\"jb51-weixin-con hide\"> \
    <h2 class=\"jb51-weixin-title\">΢��ɨһɨ</h2>\
    <div class=\"jb51-weixin-pic\"> <img src=\"http://img.jb51.net/images/weixin_jb51.gif\" alt=\"�ű�֮��΢���˺�\" width=\"100\" height=\"100\"> </div>\
  </div>\
  <a href=\"http://shequ.jb51.net/\" target=\"_blank\" class=\"question\"><img src=\"http://common.jb51.net/skin/2016/images/hot.gif\" alt=\"hot\"></a>\
  <a href=\"javascript:;\" class=\"go\"></a>\
  </div>"
$('#footer').append(gotopcode);
$(function(){
    $(window).on('scroll',function(){
        var st = $(document).scrollTop();
        if( st>0 ){
            if( $('#contents').length != 0  ){
                var w = $(window).width(),mw = $('#contents').width();
                if( (w-mw)/2 > 70 )
                    $('#gotop').css({'left':(w-mw)/2+mw+20});
                else{
                    $('#gotop').css({'left':'auto'});
                }
            }
            $('#gotop').fadeIn(function(){
                $(this).removeClass('hide');
            });
        }else{
            $('#gotop').fadeOut(function(){
                $(this).addClass('hide');
            });
        }   
    });
    $('#gotop .go').on('click',function(){
        $('html,body').animate({'scrollTop':0},500);
    });

    $('#gotop .jb51-weixin').hover(function(){
        $('#gotop .jb51-weixin-con').removeClass('hide');
    },function(){
        $('#gotop .jb51-weixin-con').addClass('hide');
    });
});
}