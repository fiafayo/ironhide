SELECT SUM( m.sks ) AS max, d.nrp, s.sksmax FROM tk_master_mk m, tk_daftar_kls d, tk_mhs s
WHERE (m.kode_mk = substring(d.kode_kelas,1,6) ) AND (s.nrp=d.nrp)
AND (m.kode_mk NOT IN ('64B065','64B801','64B081'))
AND ( d.nrp IN ( SELECT  nrp FROM tk_daftar_kls WHERE kode_kelas='64B212-13GA' )) 
 
GROUP BY d.nrp, s.sksmax
HAVING ( SUM( m.sks ) > s.sksmax );


/*








max	nrp	sksmax
22	6104010	20
26	6114005	24
26	6114017	24
25	6114018	24
26	6114060	24
26	6117009	24

*/