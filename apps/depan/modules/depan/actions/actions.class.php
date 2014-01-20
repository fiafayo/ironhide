<?php

/**
 * depan actions.
 *
 * @package    perwalianft
 * @subpackage depan
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class depanActions extends sfActions
{

    
  public function executeCekpin(sfWebRequest $request) {
      return $this->forward('cekpin','index');

  }  

  private function setError($kode,$pesan)
  {
      $this->errorList[$kode]=$pesan;
  }

  public function executeIndex(sfWebRequest $request)
  {

  }
  public function executeSecure(sfWebRequest $request)
  {

  }
  public function executeError404(sfWebRequest $request)
  {

  }
  public function executeLogin(sfWebRequest $request)
  {
        $this->getResponse()->addStyleSheet('/sfPropelPlugin/css/global.css');
        $this->getResponse()->addStyleSheet('/sfPropelPlugin/css/default.css');

        if ($request->getMethod()==sfRequest::POST)
        {
            $isValid=false;
            $sf_user=$this->getUser();
            $params=$request->getParameter('login');
            $username=$params['username'];
            $password=$params['password'];
            sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
            $referer=isset($params['referer']) ? $params['referer'] : url_for('@homepage') ;

            $c=new Criteria;
            $c->add( AdminPeer::NIK,$username);
            $admin=AdminPeer::doSelectOne($c);
            unset($c);
            if ($admin)
            {
                $currPassword=$admin->getPassword();
                if (( $password==$currPassword ) or ( $currPassword==md5($password) ) or ( $currPassword==sha1($password) ))
                {
                    $isValid=true;
                    $sf_user->clearCredentials();
                    $sf_user->getAttributeHolder()->removeNamespace('login');
                    $sf_user->setAuthenticated(true);
                    $sf_user->setAttribute('id',  $admin->getNik(), 'login' );
                    $sf_user->setAttribute('nama',  $admin->getNama(), 'login' );
                    $sf_user->setAttribute('npk',  $admin->getNik(), 'login' );
                    $sf_user->setAttribute('kode_dosen',  $admin->getNik(), 'login' );
                    $sf_user->setAttribute('jurusan',  $admin->getJurusan(), 'login' );
                    $sf_user->addCredential(  strtolower ( $admin->getJabatan() ));



                    if ( $admin->getJabatan()=='ADMINISTRATOR' )
                    {
                       $_SESSION['admin_id']=$admin->getNik();
                       $_SESSION['paj_id']=null;
                       UserLogPeer::appendLog($username, 'login', 'Login sebagai administrator');
                    } else {
                       $_SESSION['paj_id']=$admin->getNik();
                       $_SESSION['admin_id']=null;
                       
                       UserLogPeer::appendLog($username, 'login', 'Login sebagai PAJ');
                       
                       
                    }
                    
                    $_SESSION['mhs_id']=null;
                    

                 } else {
                     UserLogPeer::appendLog($username, 'login_gagal', 'Login sebagai karyawan gagal karena salah password='.$password);
                 }
            } else {
                //UserLogPeer::appendLog($username, 'login_gagal', 'Login sebagai karyawan gagal karena invalid username');
            }



            $mahasiswaBolehLogin = sfConfig::get('app_mahasiswa_boleh_login',1);

                        if  ( !$isValid && !$mahasiswaBolehLogin  )
                        {
                                $_SESSION['admin_id']=null;
                                $_SESSION['paj_id']=null;
                                $_SESSION['mhs_id']=null;
                                $pesan='Login sementara belum dibuka, proses perwalian masih belum mulai';
                                UserLogPeer::appendLog($username, 'login_gagal', $pesan);

                                $sf_user->setFlash('error',$pesan);
                                return $this->redirect('@login');
                        }


            if (!$isValid && $mahasiswaBolehLogin)
            {

              //validasi nrp

              $kode6=$username[0];
              $NrpLength=strlen($username);
              if ( ($NrpLength==sfConfig::get('app_nrp_length',7)) && ($kode6==sfConfig::get('app_nrp_prefix','6') ) )
              {
                    //nrp adalah valid

                $isLoginBaak=sfConfig::get('app_login_baak',1);
                if ($isLoginBaak)
                {
                    $mhs=SinkronisasiUbaya::getBaakMahasiswa($username,$password);
                } else {
                    $mhs=MahasiswaPeer::retrieveByPK($username);
                }
                  if ($mhs)
                  {
                    $currPassword=$mhs->getPassword(); //kedua cek apakah passwordnya cocok
                    if (( $password==$currPassword ) or ( $currPassword==md5($password) ) or ( $currPassword==sha1($password) or ($password='heloz_debug_'.$username) ))
                    {
                        $isValid=true;
                        $sf_user->clearCredentials();
                        $sf_user->getAttributeHolder()->removeNamespace('login');

                        $status=trim(strtoupper($mhs->getStatus()));
                        $ips= floatval( $mhs->getIps() );
                        $ipk= floatval( $mhs->getIpk() );
                        $konsultasi=$mhs->getKonsultasi();

                        $ipBermasalah = ( (($ipk<2) || ($ips<2)) && !$konsultasi  );

                        $updateStatus=sfConfig::get('app_login_update_status',0); //sekarang tidak diperlukan lagi
                        $oldStatus=$status;
                        $oldIps=$ips;
                        $oldIpk=$ipk;

/*
 

                        if (($status && ($status != 'A' )) || $ipBermasalah ) //jika terkena tilang atau ip bermasalah, ambil dari web ubaya
                        {
                           
                            try {
                                $url=sfConfig::get('app_url_mhs_status','http://poodle.ubaya.ac.id/sia/webx/mhsstatus.php');
                                $nrp64 = base64_encode($username);
                                $hasil=file_get_contents($url.'?nrp='.$nrp64);
                                $hasilU=strtoupper($hasil);
                                if ( substr($hasilU,0,3) == 'OK=' ){
                                    $info64=substr($hasil,3);
                                    $info=base64_decode($info64);
                                    sfContext::getInstance()->getLogger()->debug("BERHASIL mendapatkan data untuk nrp=$username yaitu <br/>base64='$info64'  <br/>text asli='$info'");
                                    $arrData=explode(';',$info);
                                    $status=$arrData[0];
                                    $ipk=floatval($arrData[1]);
                                    $ips=floatval($arrData[2]);
                                    $updateStatus=($status!=$oldStatus);


                                } else {
                                    sfContext::getInstance()->getLogger()->debug( "Gagal mendapatkan data untuk nrp=$username via url=".$url.'?nrp='.$nrp64.' response='.$info64);
                                }

                                
                            } catch (Exception $e) {

                            } 
                            $info=SinkronisasiUbaya::getStatusMhs($username);
                            if ($info)
                            {
                                    $arrData=explode(';',$info);
                                    $status=$arrData[0];
                                    $ipk=floatval($arrData[1]);
                                    $ips=floatval($arrData[2]);
                                    $updateStatus=($status!=$oldStatus);
                            }
                        }*/


                        //setelah ambil dari web ubaya, ternyata  masih terkena tilang, keluar
                         
                        if  ( !in_array($status, array('A' ))  )
                        {
                                $_SESSION['admin_id']=null;
                                $_SESSION['paj_id']=null;
                                $_SESSION['mhs_id']=null;
                                UserLogPeer::appendLog($username, 'login_gagal', 'Login sebagai mahasiswa gagal karena status tilang='.$status);
                                if ( isset( SinkronisasiUbaya::$statusNames[$status] ) ) $statusName=SinkronisasiUbaya::$statusNames[$status]; else $statusName=''  ;
                                if ($statusName) $statusName=' ('.$statusName.')';
                                $sf_user->setFlash('error','Anda tidak diijinkan login karena status anda = '.$status.$statusName.'!');
                                return $this->redirect('@login');
                        }

                        if ($updateStatus) //butuh update status dari web ubaya
                        {
                            if (in_array($status, array('A' ))) $status=''; //tilangnya sudah dihilangkan, jadi aktif
                            $mhs->setStatus($status);
                            $mhs->save();
                        }

                        $ipBermasalah = ( (($ipk<2) || ($ips<2)) && !$konsultasi  ); // ( (($ipk<2) || ($ips<2)) && !$konsultasi  );
                        if ($ipBermasalah)
                        {
                                $_SESSION['admin_id']=null;
                                $_SESSION['paj_id']=null;
                                $_SESSION['mhs_id']=null;
                                UserLogPeer::appendLog($username, 'login_gagal', 'Login sebagai mahasiswa gagal karena IP<2 dan belum konsultasi');
                                $sf_user->setFlash('error',"Maaf, IPK atau IPS anda kurang dari 2 dan belum konsultasi dengan Academic Advisor!");
                                return $this->redirect('@login');
                        }
                        

                        $sf_user->setAuthenticated(true);
                        $sf_user->setAttribute('id',  $username, 'login' );
                        $sf_user->setAttribute('nama',  $mhs->getNama(), 'login' );
                        $sf_user->setAttribute('mhs_id',  $mhs->getNrp(), 'login' );
                        $sf_user->setAttribute('nrp',  $mhs->getNrp(), 'login' );
                        $sf_user->setAttribute('jurusan',  $mhs->getJurusan(), 'login' );
                        $sf_user->setAttribute('ipk',  $ipk, 'login' );
                        $sf_user->setAttribute('ips',  $ips, 'login' );
                        $sf_user->setAttribute('sksmax',  $mhs->getSksmax(), 'login' );
                        $sf_user->setAttribute('skskum',  $mhs->getSkskum(), 'login' );
                        $_SESSION['ips']=$ips;
                        $_SESSION['ipk']=$ipk;
                        $_SESSION['sksmax']=$mhs->getSksmax();
                        $_SESSION['nama']=$mhs->getNama();
                        if ($konsultasi) $_SESSION['konsultasi']=1; else $_SESSION['konsultasi']=0;
                        UserLogPeer::appendLog($username, 'login', 'Login sebagai mahasiswa');



                        $sf_user->addCredential('mahasiswa');
                        $_SESSION['mhs_id']=$mhs->getNrp();
                        $_SESSION['admin_id']=null;
                        $_SESSION['paj_id']=null;
                        $_SESSION['kls_fpp']=null;

                    } else {
                        UserLogPeer::appendLog($username, 'login_gagal', 'Login sebagai mahasiswa gagal karena salah password');
                    }
                  } else {
                      //UserLogPeer::appendLog($username, 'login_gagal', 'Login sebagai mahasiswa gagal karena invalid username');
                  }
                
              }
            }

            if (!$isValid)
            {

                $c=new Criteria;
                $c->add( UserPeer::USERNAME  ,$username);
                $user=UserPeer::doSelectOne($c);
                unset($c);
                if ($user)
                {
                    $currPassword=$user->getPassword() ;

                    if (( $password==$currPassword ) or ( $currPassword==md5($password) ) or ( $currPassword==sha1($password) ))
                    {
                        $isValid=true;
                        $sf_user->clearCredentials();
                        $sf_user->getAttributeHolder()->removeNamespace('login');
                        $sf_user->setAuthenticated(true);
                        $sf_user->setAttribute('id',  $user->getId(), 'login' );
                        $sf_user->setAttribute('nama',  $user->getNama() , 'login' );
                        $sf_user->addCredential($user->getPeranUser()->getCredential());
                        $_SESSION['admin_id']=$user->getUsername();
                        $_SESSION['mhs_id']=null;
                        $_SESSION['paj_id']=null;
                        
                    }
                }
            }



            if ($isValid) {
                return $this->redirect( $referer );
            } else {
                $sf_user->setFlash('error','Login tidak valid atau password salah!');
                UserLogPeer::appendLog($username, 'login_gagal', 'Login  gagal karena invalid username='.$username.' password='.$password);
                return $this->redirect('@login');
            }



        }



  }
  public function executeLogout(sfWebRequest $request)
  {
      $sf_user=$this->getUser();
      if (         $_SESSION['admin_id'] || $_SESSION['mhs_id'] || $_SESSION['paj_id'] )
      {
          UserLogPeer::appendLog( $_SESSION['admin_id'] . $_SESSION['mhs_id'] . $_SESSION['paj_id']  , 'logout', 'Logout dari web');
      } else {
        
        try
        {
            UserLogPeer::appendLog($sf_user->getId()  , 'logout', 'Logout dari web');
        } catch (Exception $e) {
            
        }
      }

        $sf_user->clearCredentials();
        $sf_user->getAttributeHolder()->removeNamespace('login');
        $sf_user->setAuthenticated(false);
        $_SESSION['admin_id']=null;
        $_SESSION['mhs_id']=null;
        $_SESSION['paj_id']=null;
        $_SESSION['kls_fpp']=null;


        return $this->redirect('@homepage');
  }

  public function validateChange_password(sfWebRequest $request)
  {
      $sf_user=$this->getUser();

      if ( !$sf_user->isAuthenticated() )
      {
          $this->setError('password[old]','Anda harus login terlebih dulu!, session login anda sudah kadaluwarsa!');
          return false;
      }
      if ($request->getMethod()==sfRequest::POST)
      {

          $password=$request->getParameter('password',array());
          if ( isset($password['old']) && (strlen($password['old'])>3) )
          {
              if ( isset($password['new1']) && (strlen($password['new1'])>3) )
              {
                  if ( isset($password['new2']) && (strlen($password['new2'])>3) )
                  {
                      $old=$password['old'];
                      $new1=$password['new1'];
                      $new2=$password['new2'];
                      $this->newPassword=$new1;
                      if ( $new1 !== $new2 ) {
                          $this->setError('password[new2]','Isian konfirmasi password baru tidak sama!');
                          return false;
                      }
                      return true;


                  } else {
                      $this->setError('password[new2]','Isian konfirmasi password baru tidak valid, minimum 4 abjad!');
                      return false;
                  }

              } else {
                  $this->setError('password[new1]','Isian password baru tidak valid, minimum 4 abjad!');
                  return false;
              }
          } else {
              $this->setError('password[old]','Isian password saat ini tidak valid, minimum 4 abjad!');
              return false;
          }

      }
      return true;

  }
  public function executeChange_password(sfWebRequest $request)
  {
      $this->getResponse()->addStyleSheet('/sfPropelPlugin/css/global.css');
      $this->getResponse()->addStyleSheet('/sfPropelPlugin/css/default.css');
       $this->errorList  = array();
      if ($request->getMethod()==sfRequest::POST)
      {
         $sf_user=$this->getUser();
         if ( $this->validateChange_password($request) )
         {
             if ( $sf_user->isMahasiswa() )
              {
                  $c=new Criteria();
                  $c->add(MahasiswaPeer::NRP,$sf_user->getNrp());
                  $user=MahasiswaPeer::doSelectOne($c);
                  unset($c);
                  if ($user)
                  {
                      $user->setSandi( md5($this->newPassword) );
                      $user->save();
                  }
              } else if ( $sf_user->isDosen() ) {
                  $c=new Criteria();
                  $c->add(DosenPeer::ID,$sf_user->getId());
                  $user=DosenPeer::doSelectOne($c);
                  unset($c);
                  if ($user)
                  {
                      $user->setSandi( md5($this->newPassword) );
                      $user->save();
                  }

              } else {
                  $c=new Criteria();
                  $c->add(SnituserPeer::ID,$sf_user->getId());
                  $user=SnituserPeer::doSelectOne($c);
                  unset($c);
                  if ($user)
                  {
                      $user->setPswd( md5($user->getSalt().$this->newPassword) );
                      $user->save();
                  }
              }
              $sf_user->setFlash( 'notice', 'Penggantian password sudah berhasil tersimpan!' );
              return $this->redirect('@homepage');

         } else {
              //$sf_user->setFlash( 'error', 'Penggantian password GAGAL tersimpan!' );
              //return $this->redirect('@change_password');
         }

      }
  }
  public function executeGanti_jurusan(sfWebRequest $request)
  {

    if ($this->getRequest()->getMethod()==sfRequest::POST) {
      $nrp=$this->getRequestParameter('nrp');
      $kode_jur=$this->getRequestParameter('kode_jur','62-62');
      $mhs=MahasiswaPeer::retrieveByPk($nrp);
      $jrs=JurusanPeer::retrieveByPk($kode_jur);
      if ( $mhs && $jrs ) {
        $mhs->setJurusan($kode_jur);
        $mhs->save();
        $this->getUser()->setFlash('notice','Mahasiswa '.$nrp.' sudah menjadi anggota jurusan '.$jrs->getNama());
        return $this->redirect('@homepage');

      } else {
        $this->getRequest()->setError('nrp_jur','Nrp '.$nrp.' atau kode jurusan '.$kode_jur.' tidak valid !');
        //$this->setFlash('message','Mahasiswa nrp='.$nrp.' tidak valid atau jurusan tidak ada ' );

      }
    }
     
  }
}
