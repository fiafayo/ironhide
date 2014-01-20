<?php
class DataFormatter{
    
  public static $romawiNames = array(1=>'I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
  public static $dayNames = array(
      0=>'Minggu',
      'Senin',
      'Selasa',
      'Rabu',
      'Kamis',
      'Jumat',
      'Sabtu'
    );
  public static $monthNames = array(
      1=>'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'Nopember',
      'Desember'
    );
  public static $shortMonthNames = array(
      1=>'Jan',
      'Feb',
      'Mar',
      'Apr',
      'Mei',
      'Jun',
      'Jul',
      'Agu',
      'Sep',
      'Okt',
      'Nop',
      'Des'
    );
  public static function getMonthNames(){     
    return self::$monthNames;
  }
  public static function getDayNames(){
     
    return self::$dayNames;
  }
  public static function getMonthName($bulan=null){
    if (!$bulan) $bulan=date('m');
    $bulan=intval($bulan);
    $names=self::getMonthNames();
    $name='';
    if ( array_key_exists($bulan,$names) ) $name=$names[$bulan];
    return $name;
  }

  public static function stripCommas($val){
    $return=str_replace(',','',$val);
    //$return=str_replace(',','.',$return);
    return $return;
  }

  public static function addCommas($val,$digit=0){
    return number_format($val,$digit,'.',',');
  }
  public static function generateId($prefix='PR')
  {
    $now = time();
    $y = self::convert2Id(date("Y",$now) % 100) ;
    $m = self::convert2Id(date('m',$now));
    $d = self::convert2Id(date('d',$now)) ;
    $h = self::convert2Id(date('G',$now));
    $n = self::convert2Id(date('i',$now));
    $s = self::convert2Id(date('s',$now));
    $time = explode(' ',microtime());
    $ms = intval($time[0] * 10000);
    $id = $prefix.$y.$m.$d.$h.$n.$s.$ms;
    return $id;
  }

  public static function convert2Id($num) {
    $n = intval($num);
    if ($n<=9) $d = chr (  ord('0') + $n  );
    else if ($n<=35) $d = chr (  ord('A') + $n - 10 );
    else $d= chr ( ord('a') + $n - 36);
    return $d;
  }

  public static function stripNonNumber($campur){
    $hasil='';
    for ($i=0; $i< strlen($campur); $i++)
    {
      $c=ord( $campur[$i] );
      if (($c>=0x30) && ($c<=0x39))
      {
        $hasil.=$campur[$i];
      }
    }
    return $hasil;
  }
  public static function stripNpwpDots($campur){
    return self::stripNonNumber($campur);
  }
  public static function formatNpwp($angka){
    $return=null;
    $angkaNormal=self::stripNpwpDots($angka);
    if ($angkaNormal)
    {
      $return=sprintf("%s.%s.%s.%s-%s.%s",
        substr($angkaNormal,0,2),
        substr($angkaNormal,2,3),
        substr($angkaNormal,5,3),
        substr($angkaNormal,8,1),
        substr($angkaNormal,9,3),
        substr($angkaNormal,12,3)
      );
    }
    return $return;
  }
  public static function explodeNpwp($angka){
    return array(
      substr($angka,0,2),
      substr($angka,2,3),
      substr($angka,5,3),
      substr($angka,8,1),
      substr($angka,9,3),
      substr($angka,12,3)
    );
  }

  public static function addDaysWithDate($date,$days){

      $isUasGenap20132014 = sfConfig::get('app_uas_genap_20132014',0);
      if ($isUasGenap20132014) {
        if ($days==8) {
            $days=14;
        }
      }      
      
      
    $date = strtotime("+".$days." days", strtotime($date));

    
    
    return  date("Y-m-d", $date);

  }
  
  public static function dateToMyString($date='1977-06-15') {
      list($thn,$bln,$tgl) = explode('-',$date);
      $thn=intval($thn);
      $bln=intval($bln);
      $tgl=intval($tgl);

      return sprintf("%s/%s/%s",$tgl, self::$shortMonthNames[$bln],$thn);
  }

}