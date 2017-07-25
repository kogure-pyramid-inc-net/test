<?PHP
	function debugvardump($function_name,$line,$var)
    {
        fputs(STDOUT, "\n".$function_name.":line=".$line );
        fputs(STDOUT, "\n---------------\n" );
        fputs(STDOUT, var_export($var,true) );	//var_dump()の代わり
//error_log(var_export($addItems,true));
        fputs(STDOUT, "\n---------------\n" );
    }

/*
                    //結果を集計用配列に貯める
                foreach( $ret->character_list as $k2 => $v2 ){
                    if ( isset( $gacha_summary[$v->gacha_id]["COUNT"] ) === false ){
                        $gacha_summary[$v->gacha_id]["COUNT"] = 0;
                    }
                    if ( isset( $gacha_summary[$v->gacha_id][$v2->character_id] ) === false ){
                        $gacha_summary[$v->gacha_id][$v2->character_id] = 0;
                    }

                    $gacha_summary[$v->gacha_id][$v2->character_id]++;
                    $gacha_summary[$v->gacha_id]["COUNT"]++;
                }
*/
/*
		//GachaController.php lotActionの固定戻り値
		//動作確認で固定データ
    	$this->view->character_list = [];
    	$this->view->character_list[] = ["character_id" => "char1", "level" => 1];
    	$this->view->character_list[] = ["character_id" => "char2", "level" => 10];
    	$this->view->character_list[] = ["character_id" => "char1", "level" => 10];
*/

    //2次元配列のforeachの確認
    function test_foreach()
    {
        $ary = [
            ['id'=>0,'fruit'=>'apple','name'=>'aaa'],
            ['id'=>1,'fruit'=>'banana','name'=>'bbb'],
        ];

        foreach($ary as $v){
            printf( "\nv=\n" );
            var_dump($v);
        }

        printf("\n----------\n");

        foreach($ary as $k => $v){
            printf( "k=\n" );
            var_dump($k);
            printf( "v=\n" );
            var_dump($v);
        }
    }

    //2次元配列への項目追加
    function test_foreach2()
    {
        $ary = [
            ['id'=>0,'fruit'=>'apple','name'=>'aaa'],
            ['id'=>1,'fruit'=>'banana','name'=>'bbb'],
        ];

        foreach($ary as &$v){
            $v["fefe"] = "ss";
        }
        var_dump($ary);

        foreach($ary as $k => $v){
            $ary[$k]["hehe"] = $k;
        }
        var_dump($ary);
    }

    //2次元配列の値を探す
    function test_arrayserch()
    {
        $ary = [
            ['id'=>0,'fruit'=>'apple','name'=>'aaa'],
            ['id'=>10,'fruit'=>'banana','name'=>'bbb'],
        ];

        $ret = $ary[array_search('banana',array_column($ary,'fruit'))];

        var_dump($ret);
    }

    //objectの配列から値を探す
    function test_arrayfilter()
    {
        $ary = [
            (object)['id'=>0,'fruit'=>'apple','name'=>'aaa'],
            (object)['id'=>10,'fruit'=>'banana','name'=>'bbb'],
        ];

        $compare_property = 'fruit';
        $compare_value = 'banana';

        //こっちか
        $callback = function ($arg_array_v) use ($compare_property, $compare_value)
                    {
                        var_dump($arg_array_v->$compare_property);
                        return($arg_array_v->$compare_property == $compare_value);
                    };
        $ret = array_filter($ary, $callback);
        //こっちか
//        $ret = array_filter($ary,
//                            function ($arg_array_v) use ($compare_property, $compare_value)
//                            {
//                                var_dump($arg_array_v->$compare_property);
//                                return($arg_array_v->$compare_property == $compare_value);
//                            }
//        );
        var_dump($ret);
    }

    //転置配列
    function test_arraymerge()
    {
        $array = [
            [1,2,3],
            ["b1","b2","b3"],
            ["c1","c2","c3"],
        ];

        $ret = call_user_func_array('array_map',array_merge(array(null), $array ));

        var_dump($ret);
    }

    //
    function test_arrayTransposeWithKey()
    {
        $array = [
            "a" => [1,2,3],
            "b" => ["b1","b2","b3"],
            "c" => ["c1","c2","c3"],
        ];

        $ret = [];

        foreach ($array as $key => $ary2) {
            foreach ($ary2 as $k => $v) {
                $ret[$k][$key] = $v;
            }
        }

        var_dump($ret);
    }

printf("\n----test_foreach()------\n");
test_foreach();
printf("\n----test_foreach2()------\n");
test_foreach2();
printf("\n----test_arraysearch------\n");
test_arrayserch();
printf("\n----test_arrayfilter------\n");
test_arrayfilter();
printf("\n----test_arraymerge------\n");
test_arraymerge();
printf("\n----test_arrayTransposeWithKey------\n");
test_arrayTransposeWithKey();
?>