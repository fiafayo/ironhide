<?php

define ('IS_DEBUG',true);
	session_start();
	include('inc/functions/connectdb.php');
	include('inc/functions/f_mhs.php');
	include('inc/functions/f_kls_mk.php');
	include('inc/functions/f_fpp.php');
	include('inc/functions/f_mk.php');
	include('inc/functions/f_ujian.php');
	include('inc/functions/f_prasyarat.php');
	include('inc/functions/f_tambah_sks.php');
	checkStatusPerwalian();
define('KODE_BAHASA_INGGRIS', '60B601');
  $errorList=array(
      1=> "Pengisian data kurang lengkap",
      2=>"Kode MK dan KP tidak ada / tutup",
      3=>"Data sudah ada",
      4=>"Terjadi tubrukan jadwal kuliah",
      5=>"Terjadi tubrukan jadwal ujian",
      6=>"Mata kuliah yang telah diterima tidak boleh dihapus",
      7=>"Mata kuliah Prasyarat tidak terpenuhi/SKS minimum tidak terpenuhi",
      8=> "Jumlah total SKS melebihi SKS maksimum",
      11=>"Status mata kuliah sebagai prasyarat paralel",
      12=>"Kapasitas kelas penuh",
      13=>"Hapus mata kuliah pengganti terlebih dahulu",
      14=>"Tidak ada kelas mata kuliah yang disimpan",
      22=>"Anda harus terlebih dahulu lulus test TOEFL"
  );
  $infoList=array(
      1=> "Pendaftaran kelas mata kuliah telah terupdate",
      2=> "Pendaftaran telah tercatat"
  );
	$bukaFpp = getAktifFpp();
	$semester =  $bukaFpp['semester'];
	$tahun =  $bukaFpp['tahun'];
	$jenis = $bukaFpp['jenis'];
	$nrp = $_SESSION['mhs_id'];

	$cekSession= $_SESSION['kls_fpp'];
	if(count($cekSession)==0 || !$cekSession)	{
		$pending = pendingPerwalianMhs($semester,$tahun,$nrp);
		foreach($pending as $klsPending)	{
			$idx = count($daftarKls);
			$daftarKls["$idx"]['kode_kelas'] = $klsPending['kode_kelas'];
			$daftarKls["$idx"]['status'] = $klsPending['status'];
			$_SESSION['kls_fpp'] = $daftarKls;
		}
	}

	if($_POST['cmdSimpanFpp'])	{
		if($_SESSION['kls_fpp'])	{
			$daftarKls= $_SESSION['kls_fpp'];
			$kode_fpp = $bukaFpp['kode_fpp'];

			$idx = count($daftarKls);
			$result = 	inputMhsKls($kode_fpp,$daftarKls,$nrp);
			if($result)	{
				header("Location:daftar_mk.php?inf=2");
				$_SESSION['kls_fpp']='';
			}
		}
		else	{
			header("Location:daftar_mk.php?error=14");
                        exit;
		}
	}

	if($_POST['cmdTambah'])	{
		if(($_POST['txtKodeMk']!="") && ($_POST['txtKp']!=""))	{
			$kode_mk = strtoupper($_POST['txtKodeMk']);
			$kp = strtoupper($_POST['txtKp']);
			$kode_fpp = $bukaFpp['kode_fpp'];
			$nrp = $_SESSION['mhs_id'];

                        $kodeMkToSearch = substr($kode_mk, 0, strlen(KODE_BAHASA_INGGRIS) );

                        if ($kodeMkToSearch == KODE_BAHASA_INGGRIS) {
                            $isLulusToefl = isSudahToefl($nrp);
                            if ( !$isLulusToefl )
                            {
                                header("Location:daftar_mk.php?error=22");
                                exit;
                            }
                        }

			if($_SESSION['kls_fpp'])	{
				$daftarKls= $_SESSION['kls_fpp'];
			}
			$idx = count($daftarKls);


			$kode_kelas = generateKodeKelas($kode_mk,$kp,$semester,$tahun);
			if(checkAvailable($kode_mk,$kp,getJurusanMhs($nrp))==1)	{
				if(checkDuplicateDaftar($daftarKls,$kode_kelas)==0)	{
					if(checkPrasyarat($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true)	{
						if(checkJadwalTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false)	{
							if(checkUjianTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false)	{
								if(checkJumlahSks($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true)	{
                                                                    if ( $bukaFpp['jenis']=='KK' ){
                                                                        if(checkKelasPenuh($kode_kelas,$nrp)==true)
                                                                        {
                                                                            header("Location:daftar_mk.php?error=12");
                                                                            exit;
                                                                        }
                                                                    }

										
                                                                    $daftarKls["$idx"]['kode_kelas'] = $kode_kelas;
                                                                    $daftarKls["$idx"]['status'] = '0';
                                                                    $_SESSION['kls_fpp'] = $daftarKls;


								}
								else	{
									header("Location:daftar_mk.php?error=8");
                                                                        exit;
								}
							}
							else	{
								header("Location:daftar_mk.php?error=5");
                                                                exit;
							}
						}
						else	{
							header("Location:daftar_mk.php?error=4");
                                                        exit;
						}
					}
					else	{
						header("Location:daftar_mk.php?error=7");
                                                exit;
					}
				}
				else	{
					header("Location:daftar_mk.php?error=3");
                                        exit;
				}
			}
			else	{
				header("Location:daftar_mk.php?error=2");
                                exit;
			}
		}
		else	{
			header("Location:daftar_mk.php?error=1");
                        exit;
		}
	}

	if($_POST['add'])	{
		$kode_fpp = $bukaFpp['kode_fpp'];
		$nrp =$_SESSION['mhs_id'];
		$kode_kelas = $_POST['add'];
		$kode_fpp = $bukaFpp['kode_fpp'];

                        $kodeMkToSearch = substr($kode_kelas, 0, strlen(KODE_BAHASA_INGGRIS) );

                        if ($kodeMkToSearch == KODE_BAHASA_INGGRIS) {
                            $isLulusToefl = isSudahToefl($nrp);
                            if ( !$isLulusToefl )
                            {
                                header("Location:daftar_mk.php?error=22");
                                exit;
                            }
                        }

		if($_SESSION['kls_fpp'])	{
			$daftarKls= $_SESSION['kls_fpp'];
		}
		$idx = count($daftarKls);

		if(checkDuplicateDaftar($daftarKls,$kode_kelas)==0)	{
			if(checkPrasyarat($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true)	{
				if(checkJadwalTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false)	{
					if(checkUjianTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false)	{
						if(checkJumlahSks($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true)	{
                                                                    if ( $bukaFpp['jenis']=='KK' ){
                                                                        if(checkKelasPenuh($kode_kelas,$nrp)==true)
                                                                        {
                                                                            header("Location:daftar_mk.php?error=12");
                                                                            exit;
                                                                        }
                                                                    }


                                                                    $daftarKls["$idx"]['kode_kelas'] = $kode_kelas;
                                                                    $daftarKls["$idx"]['status'] = '0';
                                                                    $_SESSION['kls_fpp'] = $daftarKls;

//							if(checkKelasPenuh($kode_kelas,$nrp)==false)	{
//								$daftarKls["$idx"]['kode_kelas'] = $kode_kelas;
//								$daftarKls["$idx"]['status'] = '0';
//								$_SESSION['kls_fpp'] = $daftarKls;
//
//							}
//							else	{
//								header("Location:daftar_mk.php?error=12");
//							}
						}
						else	{
							header("Location:daftar_mk.php?error=8");
                                                        exit;
						}
					}
					else	{
						header("Location:daftar_mk.php?error=5");
                                                exit;
					}
				}
				else	{
					header("Location:daftar_mk.php?error=4");
                                        exit;
				}
			}
			else	{
				header("Location:daftar_mk.php?error=7");
                                exit;
			}
		}
		else	{
			header("Location:daftar_mk.php?error=3");
                        exit;
		}

	}

	if($_GET['kode'])	{
		if($_SESSION['kls_fpp'])	{
			$daftarKls= $_SESSION['kls_fpp'];
		}
		$idx = count($daftarKls);
		$kode_fpp = $bukaFpp['kode_fpp'];
		$kode_kls = base64_decode($_GET['kode']);
		$status = getStatusDaftar($kode_fpp,$kode_kls,$_SESSION['mhs_id']);
		//if($status['status']=='0' || $status['status']=='3')	{
			if(checkMkParalel($daftarKls,$kode_kls,$_SESSION['mhs_id'])==0)	{
				if(checkMkHapusKK($daftarKls,$kode_kls)==0)	{
					$delete = 0;
					for($i=0;$i<$idx;$i++)	{
						if($daftarKls[$i]['kode_kelas']==$kode_kls || $delete==1)	{
							if($daftarKls[$i]['status']=='3')	{
								$daftarKls[$i]['status'] ='1';
								break;
							}
							else if($daftarKls[$i]['status']=='0')	{
								$daftarKls[$i]['kode_kelas']=$daftarKls[$i+1]['kode_kelas'];
								$daftarKls[$i]['status']=$daftarKls[$i+1]['status'];
								$delete=1;
                                                                //isdebug
                                                                //print "DEBUG: delete ".$kode_kls;
							}
						}
					}
					if($delete==1)	{
						array_pop($daftarKls);
					}
					$_SESSION['kls_fpp'] = $daftarKls;
					header("Location:daftar_mk.php?inf=1");
                                        exit;
				}
				else	{
					header("Location:daftar_mk.php?error=13");
                                        exit;
				}
			}
			else	{
				header("Location:daftar_mk.php?error=11");
                                exit;
			}
	}

	if($_GET['batal'])	{
		if($_SESSION['kls_fpp'])	{
			$daftarKls= $_SESSION['kls_fpp'];
		}
		$idx = count($daftarKls);
		$kode_kelas = base64_decode($_GET['batal']);


		if(checkDuplicateBatal($daftarKls,$kode_kelas)==0)	{
			if(checkMkParalelKK($daftarKls,$kode_kelas,$_SESSION['mhs_id'])==true)	{
				for($i=0;$i<$idx;$i++)	{
					if($daftarKls[$i]['kode_kelas']==$kode_kelas)	{
						$daftarKls[$i]['status']='3';
                                                $nrp =$_SESSION['mhs_id'];
                                                $kode_fpp = $bukaFpp['kode_fpp'];
                                                appendLog('batal', $kode_kelas , 'batal ambil '.$kode_kelas, $nrp, $kode_fpp, $kode_kelas);
						break;
					}
				}

                                $nrp =$_SESSION['mhs_id'];
				$_SESSION['kls_fpp'] = $daftarKls;
//                            $tempDaftarKls = array();
//                            foreach ($daftarKls as $dft) {
//                                if($dft['kode_kelas']!=$kode_kelas) {
//                                    $tempDaftarKls[]=$dft; //dicopy selain kelas dihapus
//                                }
//                            }
//                            $_SESSION['kls_fpp'] = $tempDaftarKls;

                            if ( IS_DEBUG  && ($nrp == '6114002') )    {
                                $flog=fopen('/tmp/debug_6114002.log','w');
                                fwrite($flog, "Dibatalkan kode $kode_kelas");
                                fwrite( $flog,  print_r($_SESSION,true)  );
                                fclose($flog);
                            }
                            //header("Location:daftar_mk.php?inf=1");
                            //exit;

			}
			else	{
				header("Location:daftar_mk.php?error=11");
                                exit;
			}
		}
		else	{
			header("Location:daftar_mk.php?error=9");
                        exit;
		}
	}

	if($_POST['cmdTambahKK'])	{
		if(($_POST['txtKodeMkKK']!="") && ($_POST['txtKpKK']!=""))	{
			$kode_mk = strtoupper($_POST['txtKodeMkKK']);
			$kp = strtoupper($_POST['txtKpKK']);
			$kode_fpp = $bukaFpp['kode_fpp'];
			$nrp = $_SESSION['mhs_id'];
                        
                        $kodeMkToSearch = substr($kode_mk, 0, strlen(KODE_BAHASA_INGGRIS) );

                        if ($kodeMkToSearch == KODE_BAHASA_INGGRIS) {
                            $isLulusToefl = isSudahToefl($nrp);
                            if ( !$isLulusToefl )
                            {
                                header("Location:daftar_mk.php?error=22");
                                exit;
                            }
                        }

			if($_SESSION['kls_fpp'])	{
				$daftarKls= $_SESSION['kls_fpp'];
			}
			$idx = count($daftarKls);

			$kode_kelas=generateKodeKelas($kode_mk,$kp,$semester,$tahun);
			$statusKK = getDetailManageKK($kode_fpp);
			if(checkAvailable($kode_mk,$kp,getJurusanMhs($nrp))==1)	{
				if(checkDuplicateDaftar($daftarKls,$kode_kelas)==0)	{
					if(checkKelasPenuh($kode_kelas,$nrp)==false)	{
						if(checkPrasyarat($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true || $statusKK['mk_p']=='0')	{
							if(checkJadwalTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false  || $statusKK['jwd_kul']=='0')	{
								if(checkUjianTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false  || $statusKK['jwd_ujian']=='0')	{
									if(checkJumlahSks($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true)		{
										$daftarKls["$idx"]['kode_kelas'] = $kode_kelas;
										$daftarKls["$idx"]['status'] = '0';
										$_SESSION['kls_fpp'] = $daftarKls;
										if($result)	{
											header("Location:daftar_mk.php?inf=2");
                                                                                        exit;
										}
									}
									else	{
										header("Location:daftar_mk.php?error=8");
                                                                                exit;
									}
								}
								else	{
									header("Location:daftar_mk.php?error=5");
                                                                        exit;
								}
							}
							else	{
								header("Location:daftar_mk.php?error=4");
                                                                exit;
							}
						}
						else	{
							header("Location:daftar_mk.php?error=7");
                                                        exit;
						}
					}
					else	{
						header("Location:daftar_mk.php?error=12");
                                                exit;
					}
				}
				else	{
					header("Location:daftar_mk.php?error=3");
                                        exit;
				}
			}
			else	{
				header("Location:daftar_mk.php?error=2");
                                exit;
			}
		}
		else	{
			header("Location:daftar_mk.php?error=1");
                        exit;
		}
	}

	if($_POST['addKK'])	{
		$kode_kelas =$_POST['addKK'];
		$kode_fpp = $bukaFpp['kode_fpp'];
		$nrp = $_SESSION['mhs_id'];

                        $kodeMkToSearch = substr($kode_kelas, 0, strlen(KODE_BAHASA_INGGRIS) );

                        if ($kodeMkToSearch == KODE_BAHASA_INGGRIS) {
                            $isLulusToefl = isSudahToefl($nrp);
                            if ( !$isLulusToefl )
                            {
                                header("Location:daftar_mk.php?error=22");
                                exit;
                            }
                        }


		if($_SESSION['kls_fpp'])	{
			$daftarKls= $_SESSION['kls_fpp'];
		}
		$idx = count($daftarKls);
		$statusKK = getDetailManageKK($kode_fpp);
		if(checkDuplicateDaftar($daftarKls,$kode_kelas)==0)	{
			if(checkKelasPenuh($kode_kelas,$nrp)==false)	{
				if(checkPrasyarat($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true || $statusKK['mk_p']=='0')	{
					if(checkJadwalTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false  || $statusKK['jwd_kul']=='0')	{
						if(checkUjianTubrukan($daftarKls,$nrp,$semester,$tahun,$kode_kelas)==false  || $statusKK['jwd_ujian']=='0')	{
							if(checkJumlahSks($daftarKls,$nrp,$kode_fpp,$kode_kelas)==true)	{
								$daftarKls["$idx"]['kode_kelas'] = $kode_kelas;
								$daftarKls["$idx"]['status'] = '0';
								$_SESSION['kls_fpp'] = $daftarKls;
								if($result)	{
									header("Location:daftar_mk.php?inf=2");
                                                                        exit;
								}
							}
							else	{
								header("Location:daftar_mk.php?error=8");
                                                                exit;
							}
						}
						else	{
							header("Location:daftar_mk.php?error=5");
                                                        exit;
						}
					}
					else	{
						header("Location:daftar_mk.php?error=4");
                                                exit;
					}
				}
				else	{
					header("Location:daftar_mk.php?error=7");
                                        exit;
				}
			}
			else	{
				header("Location:daftar_mk.php?error=12");
                                exit;
			}
		}
		else	{
			header("Location:daftar_mk.php?error=3");
                        exit;
		}
	}

	if($_POST['cmdProses'])	{
		if($_SESSION['kls_fpp'])	{
			$daftarKls= $_SESSION['kls_fpp'];
		}
		$pesan = prosesKK($daftarKls,$bukaFpp['kode_fpp'],$_SESSION['mhs_id']);
		if($pesan==1)	{
			$_SESSION['kls_fpp']='';
			header("Location:daftar_mk.php?inf=3");
                        exit;
		}
	}
 
include_once 'inc/_top.php';
?>
            <table width="540" border="0" cellspacing="0" cellpadding="0" class="contentWrapper">
          <tr>
            <td width="544" class="headerMenu">Proses Perwalian <? echo $bukaFpp['jenis']."  ".$bukaFpp['semester']." ".$bukaFpp['tahun'];?></td>
          </tr>
          <tr>
            <td align="center"><?
	    $status=trim(checkStatusMhs($_SESSION['mhs_id']));
	if(($bukaFpp) && ($status=="A"))	{
		if($bukaFpp['jenis']!='KK')	{
	?>

                  <table width="528" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="515" border="0" cellspacing="0" cellpadding="0" >
                      <tr>
                        <td colspan="2" align="center" class="subHeaderMenu">Input Perencanaan Studi - <?
						$mhs = getDetailMhs($_SESSION['mhs_id']);
						echo $mhs['nrp']." ".$mhs['nama']; ?></td>
                      </tr>
                      <tr align="center">
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td colspan="2"  class="warning" style="font-size:12px; font-weight:bold"><?php
    $error=($_REQUEST['error']) ? $_REQUEST['error'] : 0;
    $inf=($_REQUEST['inf']) ? $_REQUEST['inf'] : 0;
     
    //

    
		if ($error)	{
		    echo isset($errorList[$error]) ? $errorList[$error] : 'Undefined Error';
		}

		if ($inf)	{
		   echo isset($infoList[$inf]) ?  "<span class='information'>".$infoList[$inf]."</span>" : '&nbsp;';
		}
		if (isset( $_SESSION['infDetail']))	{
		   echo   "<br/><span class='information'>".$_SESSION['infDetail']."</span>"  ;
                   $_SESSION['infDetail'] = '';
		}
		?>
                        </td>
                      </tr>
                      <tr align="center">
                        <td colspan="2"><form name="frmDaftarMk" method="post">
                            <table width="482" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="250"><div align="right">Kode Mata Kuliah :</div></td>
                                <td width="232"><input name="txtKodeMk" type="text" class="stext" id="kodeMk" onChange="getNamaMkMhs()" size="7" maxlength="7"></td>
                              </tr>
                              <tr>
                                <td align="right">Nama Mata Kuliah : </td>
                                <td class="labelContent">&nbsp;<span id="namaMk">None</span></td>
                              </tr>
                              <tr>
                                <td><div align="right">KP : </div></td>
                                <td><input name="txtKp" type="text" class="stext" size="4" maxlength="2"></td>
                              </tr>
                              <tr>
                                <td><div align="center"> </div></td>
                                <td><input type="submit" name="cmdTambah" value="Daftar" class="sbutton">
                                    <input type="reset" name="cmdReset" value="Reset" class="sbutton"></td>
                              </tr>
                            </table>
                        </form></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td colspan="2"><div class="listTable">
                            <table width="493" cellpadding="0" cellspacing="0" >
                              <tr class="headerTable">
                                <td width="26">No</td>
                                <td width="55">Kode MK </td>
                                <td width="249"> Nama MK </td>
                                <td width="46">KP</td>
                                <td width="63">SKS</td>
                                <td width="52">Hapus</td>
                              </tr>
                              <?
						  $daftarKls = $_SESSION['kls_fpp'];
			//$daftarKls = selectDaftarKls($bukaFpp['kode_fpp'],$_SESSION['mhs_id']);
			if($daftarKls && getPending($daftarKls)!=0)	{
				$i=0;$dmbPending=0;
				foreach($daftarKls as $tampil)	{
					if($tampil['status']=='0')	{
						$i++;
						$kelas = getDetailKlsMk($tampil['kode_kelas']);
						$mataKuliah = getDetailMk($kelas['kode_mk']);
						$kode = $tampil['kode_kelas'];
			?>
                              <tr>
                                <td align="center"><? echo $i;?></td>
                                <td align="center"><? echo $kelas['kode_mk']; ?></td>
                                <td><? echo $mataKuliah['nama']; ?></td>
                                <td align="center"><? echo $kelas['kp']; ?></td>
                                <td align="center"><? echo $mataKuliah['sks']; ?></td>
                                <td align="center"><? echo "<a href='daftar_mk.php?kode=".base64_encode($tampil['kode_kelas'])."' onClick=\"deleteMk('". $tampil['kode_kelas'] ."')\"><img src='images/ico/delete.png'></a>"?></td>
                              </tr>
                              <?

						$sksTot = $sksTot + $mataKuliah['sks'];
						$dmb = getDetailMkJur($kelas['kode_mk'],getJurusanMhs($nrp));
						if($dmb['status_bebas']=='1')	{
							$dmbPending = $dmbPending + $mataKuliah['sks'];
						}
					}
				}
			}
			else	{	?>
                              <tr align="center">
                                <td colspan="6">Tidak ada kelas kuliah yang terdaftar </td>
                              </tr>
                              <?
			}
		?>
                            </table>
                        </div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="473"><div align="right">Total SKS yang akan diambil : </div></td>
                        <td width="43" align="right"><strong><? echo $sksTot;?></strong></td>
                      </tr>
                      <tr>
                        <td align="right">Total SKS Bebas (KP atau Tugas Akhir) : </td>
                        <td align="right" class="labelContent"><? $sks_bebas = getSksBebas($daftarKls,$_SESSION['mhs_id']);
					 						if($sks_bebas!="")	{
												echo $sks_bebas;
											}
											else	{
												echo "0";
											}?></td>
                      </tr>
                      <tr>
                        <td><div align="right">SKS Maksimum + SKS Tambahan : </div></td>
                        <td align="right"><strong>
                          <?
					  $tambah = getDetailSks($bukaFpp['semester'],$bukaFpp['tahun'],$_SESSION['mhs_id']);
					  $sks_tambah = 0;
					  if(($bukaFpp['jenis']!='I') && ($tambah))	{
				  		$sks_tambah=$tambah['jml_sks'];
					  }

						$detailMhs = getDetailMhs($_SESSION['mhs_id']);
						echo $detailMhs['sksmax']-getSksTerpakaiMhs($detailMhs['nrp'],getSemester(),getTahunAjaran())+$sks_tambah;?>
                        </strong></td>
                      </tr>
                      <tr>
                        <td><div align="right">SKS Sisa : </div></td>
                        <td align="right"><strong>
                          <?
				echo ($detailMhs['sksmax']+$sks_tambah) - $sksTot - getSksTerpakaiMhs($detailMhs['nrp'],getSemester(),getTahunAjaran()) + $dmbPending;
		?>
                        </strong></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td colspan="2">
                            <div class="warning">Jangan lupa click tombol "Simpan Pendaftaran" sebelum Keluar!</div>
                            <form name="frmSimpanFpp" method="post" action="daftar_mk.php">
                            <input type="submit" name="cmdSimpanFpp" class="sbutton" value=" Simpan Pendaftaran " onClick="return confirmSubmit()">
                        </form></td>
                      </tr>
                      <tr align="center">
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr align="left">
                        <td colspan="2"><b>* Keterangan:</b>
                          <ul>
                            <li>Perwalian <strong><? echo $bukaFpp['jenis'];?></strong> akan berakhir pada <span class="klsPenuh"><strong><? echo date("d F Y - g:i a",strtotime($bukaFpp['waktu_tutup'])-60*60).' WIB';?></strong></span>.                            </li><li>Input mata kuliah bebas yang SKS nya tidak diperhitungkan seperti TA dan Kerja Praktek dilakukan dengan menginput kode mata kuliah tersebut dengan KP -.</li>
                            <li> Penginputan mata kuliah ini tidak dapat dilakukan melalui halaman jadwal mata kuliah karena mata kuliah tersebut tidak memiliki jadwal.</li>
                          </ul></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <?
		}
		else	{
				include("inc/kk.php");
		}
	}
	else	{
	?>
                <table width="520" border="0" cellspacing="0" cellpadding="0" class="content">
                  <tr>
                    <td width="518">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" class="warning"><?
			$status = checkStatusMhs($_SESSION['mhs_id']);
			$status=trim($status);
			if($status!="A")	{
				echo "Anda sedang mengalami status $status <br> Silakan menghubungi administrator untuk keterangan lebih lanjut";
			}
			else	{
				echo "Saat ini tidak ada proses perwalian yang dibuka <br><br> Jadwal Perwalian pada semester ".getSemester()." ".getTahunAjaran()." adalah sebagai berikut :<br>";
				$tampil = selectJadwalFpp(getSemester(),getTahunAjaran());
				foreach($tampil as $fpp)	{
					echo "<br><br>".$fpp['jenis']." <br>Mulai :  ".date("d F Y g:i a",strtotime($fpp['waktu_buka']))." <br> Selesai : ".date("d F Y g:i a",strtotime($fpp['waktu_tutup']))."<br>";
				}
			}
		?>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              <?
	}
	?></td>
          </tr>
        </table>



<?php
if ($_REQUEST['error']) {
  $kode=$_REQUEST['error'];
  if ($kode && isset($errorList[$kode])) {
    //echo '<script language="Javascript">alert("'.$errorList[$kode].'");</script>';
  }
}


if ($_REQUEST['inf']) {
  $kode=$_REQUEST['inf'];
  if ($kode && isset($infoList[$kode])) {
    //echo '<script language="Javascript">alert("'.$infoList[$kode].'");</script>';
      if ($kode==7) {
          $jurusan=getJurusanMhs($nrp);
      }
  }
}
?>

<?php
include_once 'inc/_bottom.php';
 
//s$_SESSION['infDetail']='';
?>