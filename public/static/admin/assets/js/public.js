/**
 * Created by Administrator on 2018/11/16.
 */
/*
* 13行起为检测数据
*
*
*
*
*
*
* */
//检测是否为数字
function number(num){
    if(/^[0-9]*$/.test(num)){
        return true;
    }
    return false;
}
//检测是否字母
function letterCheck(num){
    if(/[A-z]/.test(num)){
        return true;
    }
    return false;
}
//检测是否字母且首字母大写
function letterOnebig(num){
    if(/^[A-Z][A-z]*$/.test(num)){
        return true;
    }
    return false;
}
//检测邮箱
function mail(num){
    if(/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/.test(num)){
        return true;
    }
    return false;
}
//检测网址
function web(num){
    if(/^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/.test(num)){
        return true;
    }
    return false;
}