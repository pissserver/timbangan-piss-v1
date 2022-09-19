<?php
    function dataTabel()
    {
		require_once('ssp.class.customize.php');
        $date_now       = date('Y-m-d');
        $date_plus      = strtotime('-30 day', strtotime($date_now));
        $week           = date('Y-m-j' , $date_plus);
        $sql_details    = array(
            'user' => 'root',
            'pass' => '',
            'db'   => 'db_piss',
            'host' => 'localhost'
			// 'user' => 'edo',
            // 'pass' => 'edocakep@007',
            // 'db'   => 'pios2',
            // 'host' => '192.168.1.46'
        );

        $table      = 'weighing';
        $primaryKey = 'weighing_id';
        $columns    = array(
                array( 'db' => 'a.weighing_id', 'dt' => 0 , 'field' => 'weighing_id', 'as' => 'weighing_id'),
                array( 'db' => 'a.nopol', 'dt' => 1 , 'field' => 'nopol', 'as' => 'nopol'),
                array( 'db' => 'b.merchant_name', 'dt' => 2 , 'field' => 'merchant_name', 'as' => 'merchant_name'),
                array( 'db' => 'a.weight_in', 'dt' => 3 , 'field' => 'weight_in', 'as' => 'weight_in'),
                array( 'db' => 'a.weight_out', 'dt' => 4 , 'field' => 'weight_out', 'as' => 'weight_out'),
                array( 'db' => 'a.noncommodity', 'dt' => 5 , 'field' => 'noncommodity', 'as' => 'noncommodity'),
                array( 'db' => 'a.rafaksi', 'dt' => 6 , 'field' => 'rafaksi', 'as' => 'rafaksi'),
                array( 'db' => 'a.netto', 'dt' => 7 , 'field' => 'netto', 'as' => 'netto'),
                array( 'db' => 'a.weighing_sts', 'dt' => 8 , 'field' => 'weighing_sts', 'as' => 'weighing_sts'),
                array( 'db' => 'CONCAT(a.time_in,"<br>",a.date_in)', 'dt' => 9 , 'field' => 'time_in', 'as' => 'time_in'),
                array( 'db' => 'a.p1', 'dt' => 10 , 'field' => 'p1', 'as' => 'p1'),
                array( 'db' => 'a.date_check', 'dt' => 11 , 'field' => 'date_check', 'as' => 'date_check',
                        'formatter' => function ($d,$row)
                        {
                            if($row['date_check'] !="" || $row['date_check'] !=NULL)
                            {
                                return 'C';
                            }
                            else
                            {
                                return '';
                            }
                        }
                    ),
                array( 'db' => 'a.p2', 'dt' => 12 , 'field' => 'p2', 'as' => 'p2'),
                array( 'db' => 'a.weighing_id', 'dt' => 13 , 'field' => 'weighing_id', 'as' => 'weighing_id',
                    'formatter' => function ($d,$row)
                    {
                        return "<button onClick='edit(\"".$d."\")' class='btn btn-outline btn-block btn-primary btn-xs'><i class='fa fa-check-square-o fa-fw'></i> Check</button>";
                    }
                ),
            );
        $join   = "from weighing a left join merchant b on(a.merchant_id=b.merchant_id)";
        $where  = "(a.date_out between '".$week."' and '".$date_now."') and a.weighing_sts != 'Masuk'";
        $result = SSP::complex( $_GET, $sql_details, $table, $primaryKey,$columns,$join,$where,NULL);
        /*$start=$_REQUEST['start'];
        $idx=0;
            foreach($result['data'] as &$res)
            {
                $res[0]=(string)$start+1;
                $start++;
                $idx++;
            }*/
        echo json_encode($result);
    }
    dataTabel();
?>