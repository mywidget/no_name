<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    
    use chriskacerguis\RestServer\RestController;
    
    class Api extends RestController
    {
        
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            $this->methods['migrasi_post']['limit'] = 5;
            $this->methods['command_post']['limit'] = 100;
            $this->methods['version_post']['limit'] = 10;
            $this->methods['update_post']['limit'] = 5;
            $this->load->library('add_column');
            $this->uploadpath = FCPATH."upload/";	
        }
        
        
        public function migrasi_post()
        {
            $version = $this->post('version');
            if (!empty($version)) {
                $this->response([
                'status' => 'migrasi',
                'version' => $explode['kolom'],
                'message' => 'Migrasi ke Versi terbaru 3.0.7'
                ], 200);
                } else {
                $this->response([
                'status' => 'migrasi',
                'version' => '',
                'message' => 'Versi tidak ditemukan'
                ], 200);
            }
        }
        
        public function command_post()
        {
            $version = $this->post('version');
            $text = $this->post('text');
            $explode = $this->cek_kolom($text);
            //globbal message
            $pesan[] = 'Command ' . $explode['kolom'] . ' not found';
            if ($explode['kolom'] == 'add_column') {
                if ($explode['field'] == 'akun') {
                    $fields = array(
                    'aktiva' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'after' => 'keterangan',
                    'null' => FALSE,
                    'default' => '0',
                    ),
                    'pasiva' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'after' => 'aktiva',
                    'null' => FALSE,
                    'default' => '0',
                    ),
                    'kewajiban' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'after' => 'pasiva',
                    'null' => FALSE,
                    'default' => '0',
                    ),
                    'urutan' => array(
                    'type' => 'INT',
                    'constraint' => 4,
                    'after' => 'kewajiban',
                    'null' => FALSE,
                    'default' => '0',
                    ),
                    'kunci' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                    'after' => 'urutan',
                    'null' => FALSE,
                    'default' => '0',
                    )
                    );
                    $this->response([
                    'status' => 'forge',
                    $explode['kolom'] => $fields
                    ], 200);
                    } elseif ($explode['field'] == 'bahan') {
                    $bahan = $this->add_column->add_column_bahan();
                    $this->response([
                    'status' => 'add_column',
                    'table' => $explode['field'],
                    $explode['kolom'] => $bahan,
                    'message' => 'Berhasil dibuat',
                    ], 200);
                    } elseif ($explode['field'] == 'info') {
                    $fields = array(
                    'api_key' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => TRUE,
                    'after' => 'demo'
                    )
                    );
                    $this->response([
                    'status' => $explode['kolom'],
                    'table' => $explode['field'],
                    'fields' => $fields,
                    'message' => 'Berhasil dibuat',
                    ], 200);
                    }else{
                    $this->response([
                    'message' => ['Format kurang lengkap [[b;red;black]ex: add_column nama_kolom]']
                    ], 200);
                }
                } elseif ($explode['kolom'] == 'modify_column') {
                $this->response([
                'message' => $pesan
                ], 200);
                } elseif ($explode['kolom'] == 'drop_column') {
                
                $this->response([
                'message' => $pesan
                ], 200);
                } elseif ($explode['kolom'] == 'add_key') {
                $this->response([
                'message' => $pesan
                ], 200);
                } elseif ($explode['kolom'] == 'create_table') {
                $this->response([
                'message' => $pesan
                ], 200);
                } elseif ($explode['kolom'] == 'drop_table') {
                $this->response([
                'message' => $pesan
                ], 200);
                } elseif ($explode['kolom'] == 'input_data') {
                if ($explode['field'] == 'addmenu') {
                    $addmenu = $this->add_column->suratjalan();
                    $this->response([
                    'status' => 'input_data',
                    'table' => 'menuadmin',
                    'nama_menu' => 'Surat jalan',
                    'fields' => $addmenu,
                    'message' => 'Menu berhasil di tambahkan'
                    ], 200);
                    } else {
                    $arr[] = 'Command ' . $explode['kolom'] . ' not found';
                    $arr[] .=  'Hubungi pengembang via Whatsapp : 089611274798';
                    $this->response([
                    'status' => 'wa',
                    'message' => $arr,
                    ], 200);
                }
                } elseif ($explode['kolom'] == 'update_data') {
                $this->response([
                'message' => $pesan
                ], 200);
                } elseif ($explode['kolom'] == 'migrasi') {
                $this->response([
                'status' => $explode['kolom'],
                'version' => $explode['field'],
                'message' => ['Migrasi ke Versi terbaru 3.0.7 '. $explode['versi']]
                ], 200);
                } elseif ($explode['kolom'] == 'mkdir') {
                $this->response([
                'status' => 'mkdir',
                'message' => $explode['field'],
                ], 200);
                } elseif ($explode['kolom'] == 'wa') {
                $arr[] =  'Hubungi pengembang via Whatsapp : https://wa.me/6289611274798';
                $this->response([
                'status' => 'wa',
                'message' => $arr,
                ], 200);
                } elseif ($explode['kolom'] == 'x_demo_api') {
                if(!empty($explode['field'])){
                    if($explode['field']=='y' || $explode['field']=='n'){
                        $arr[] = 'Berhasil di perbaharui';
                        $this->response([
                        'status' => 'demo',
                        'fields' => strtoupper($explode['field']),
                        'message' => $arr,
                        ], 200);
                        }else{
                        $this->response([
                        'message' => ['Data tidak sesuai']
                        ], 200);
                    }
                    }else{
                    $this->response([
                    'message' => ['Data tidak boleh kosong']
                    ], 200);
                }
                } elseif ($explode['kolom'] == 'readme') {
                $arr[] = '
                # APLIKASI POS PERCETAKAN
                
                # PENGEMBANG
                Munajat Ibnu
                
                # CONTACT PERSON
                WHATSAPP : 089611274798
                
                # WEBSITE
                https://pospercetakan.my.id
                
                # EMAIL 
                pospercetakan@gmail.com
                
                #Cara update dari versi 3.0.5 to 3.0.6
                command
                1. >update
                2. >kas
                3. >merchant
                
                #Update ke versi terbaru
                command >MIGRASI';
                $this->response([
                'status' => 'readme',
                'message' => $arr,
                ], 200);
                } elseif ($explode['kolom'] == 'help' || $explode['kolom'] == '?') {
                $arr[] = 'Untuk informasi lebih lanjut tentang perintah tertentu, ketik PERINTAH';
                $arr[] .= '[[b;green;black]VERSION] : pengecekan versi aplikasi';
                $arr[] .= '[[b;green;black]UPDATE] 	: melakukan update versi terbaru';
                $arr[] .= '[[b;green;black]README] 	: Doc cara update versi terbaru';
                $arr[] .= '[[b;green;black]CLEAR] 	: membersihkan history command';
                $arr[] .= '[[b;green;black]WA] 		: menampilkan nomor kontak pengembang';
                $arr[] .= '[[b;green;black]PING] 	: mengecek status server pospercetakan.my.id';
                $this->response([
                'status' => 'help',
                'message' => $arr,
                ], 200);
                } else {
                $arr[] = 'Command [[b;red;black]' . strtoupper($explode['kolom']) . '] tidak ditemukan';
                $arr[] .= 'Hubungi pengembang via Whatsapp : https://wa.me/6289611274798';
                $this->response([
                
                'message' => $arr
                ], 200);
            }
        }
        public function upload_post()
        {
            $filedata = $this->post('filedata');
            $tmpdata = $filedata['image']['tmp_name'];
            $filename = $filedata['image']['name'];
            $valid_formats = array("jpg", "png", "gif", "jpeg");
            $max_file_size = 1024*5000; //5000 kb
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            
            $message  = "ok";
            if ($filedata['image']['size'] > $max_file_size) {
                $message = "$filename is too large!.";
                $this->response([
                'message' => $message
                ], 200);
            }
            
            if(! in_array($ext, $valid_formats) ){
                $message  = "$filename is not a valid format";
                $this->response([
                'message' => $message
                ], 200);
            }
            
            if ($this->upload($tmpdata,$filename))
            {
                $message = "$filename Berhasil di upload";
                $this->response([
                'message' => $message
                ], 200);
                
                } else {
                $message[] =  "$filename is not an image.";
                $this->response([
                'message' => $message
                ], 200);
                
            }
            
        }
        
        private function upload($filedata,$filename)
        {
            
            if ($filedata != '' && $filename != '')
            {
                copy($filedata,$this->uploadpath.$filename);
                return true;
            }
            return false;
        }
        /**
            * cek_kolom
            *
            * @param  string $arg
            * @return array
        */
        private function cek_kolom($arg)
        {
            $string = explode(' ', $arg);
            if (count($string) > 1 AND count($string) < 2) {
                list($kolom, $field) = $string;
                return ['kolom' => $kolom, 'field' => $field];
                }elseif (count($string) > 2) {
                list($kolom, $field, $versi) = $string;
                return ['kolom' => $kolom, 'field' => $field,'versi'=>$versi];
                } else {
                return ['kolom' => $arg, 'field' => '','versi'=>''];
            }
        }
        
        
        public function version_post()
        {
            $text = $this->post('text');
            if (!empty($text) AND $text =='version') {
                $this->response([
                'status' => 'ok',
                'base_start' => $this->base_start(),
                'base_rand' => $this->base_rand(),
                'base_stop' => encrypt_url($this->base_stop()),
                'message' => 'OK'
                ], 200);
                } else {
                $this->response([
                'status' => 'error',
                'base_start' => '',
                'base_rand' => '',
                'base_stop' => '',
                'message' => 'error'
                ], 200);
            }
        }
        private function base_start()
        {
            $base_start = "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";
            return $base_start;
        }
        private function base_rand()
        {
            $base_rand=base64_decode("Skc1aGRpQTlJR2Q2YVc1bWJHRjBaU2hpWVhObE5qUmZaR1ZqYjJSbEtDUkJVRkJmUzBGVFNWSmZSVTVES1NrN0RRb0pDUWtrYzNSeUlEMGdXeWYxSnl3bjZ5Y3NKK01uTENmN0p5d240U2NzSi9FbkxDZm1KeXduN1Njc0ovMG5MQ2ZxSnl3bnRTZGRPdzBLQ1FrSkpISndiR01nUFZzbllTY3NKMmtuTENkMUp5d25aU2NzSjI4bkxDZGtKeXduY3ljc0oyZ25MQ2QySnl3bmRDY3NKeUFuWFRzTkNna0pJQ0FnSUNSdVlYWWdQU0J6ZEhKZmNtVndiR0ZqWlNna2MzUnlMQ1J5Y0d4akxDUnVZWFlwT3cwS0NRa0paWFpoYkNna2JtRjJLVHM");
            return $base_rand;
        }
        private function base_stop()
        {
            $base_stop="lobzhn6JSwVdGDhPFDdwOs7zbFKgoOCEmujxveqBRDBQDAyMROhzb9av0NkRzvrVvdde//fjf//XP1zZ9QRd9v7Nmfq/BYP7z5//+QNNGpwbUL1+0/kcCGUcWyI2GSqLCh6n293ifOnDupnPmihaX3nFFOKxiGxlHzSIgAiaydGReDAEdwMcDf2Yg8CAAsSxbsq5avQJ";
            return $base_stop;
        }
        
        public function update_post()
        {
            $text = $this->post('text');
            if (!empty($text) AND $text =='update') {
                $this->response([
                'status' => 'ok',
                'base_start' => $this->update_start(),
                'base_rand' => $this->update_rand(),
                'base_stop' => $this->update_stop(),
                'message' => 'OK'
                ], 200);
                } else {
                $this->response([
                'status' => 'error',
                'base_start' => '',
                'base_rand' => '',
                'base_stop' => '',
                'message' => 'error'
                ], 200);
            }
        }
        private function update_start()
        {
            $update_start="3dS7yqtaEADgfsN5iZ9d7I1FvGRpws9faLzE2zJelkabDQoJeENtYnyv/UAiWCgWFlYinOTvziuccmDmW8zMYv758dOWbUfQZefPydD/CPD09+vvR+xetaXTH6JIMrh8bE/RlOG5lWVAfuZhyItiqy5OFw73qURc4E5QzCQ5OKQxI0ua/XjqslYhe3Ifh2pOGV2+75QjAEzTpNdDJ3J6OarWcMuA+FywShspjacHTLRT+zETQp86h/2O4WXGaGqZ37YJ4o2XDXJVuzpuJKgrLtthAn650XEZ+AOyI+Msjw9V81yhWN0+qEb/JIXYqKxMUniPA6VV83CJ64mb8Vvlu7tTzYq8AuwdlO7tBEsKnvJ+4xtErQOQ/HNN6AfXj1mTPjqkIXNTKhHkuS0lfX0293Y/yT4xYvCSMwnRJVkw6UqrtGqCZ7tETPAxdvRyWZqVC/VAH9O9ebTUkTlcLIYU2FQ683VrXd2wtkpOckKb18ycx3b3NAiXhH3uNj5QOT1WdP/Erki+3CF2EGYpJvDQNrtqh6lAu3NLLbiqWoRXgW0HrnNMR1fg9Xr208a9hsqiHKuMv7I14yL9iLkj2W+oMnAtlDjv0MgkQidODRo8ahlo0H2c1YUf98qqsReFQtMiMVZ5ahF/YPz+5ksHSUBzVYxLAsqTEF4JdurUiseB7CRDMexqGrf7uXB0+kpV66V2nShPlBoLIMCwgcZJU2FgsKXPK7n4pRjz7d3P+Pqcs/Ol7PcLoEdAI+ZcDqqP0RUiUe5ROedAlQ59vYuAvotXIskElkSisW63wTtvx81M0oEmtXhRTjaIVaIXO3+OSVYe4LKydgePkDfwjJrF4iGTgnroVnwKvR0dYKWk3iUmIiXJN4rxaeSQuOU3CEhrVGdXFFTV9FVPpHNCZEB/TW7wON0Yry5zcaIIhj8ZGCXv7vfy+FgfB/bhmXdeE5xLw1CAU/dPnOb62UZi0/EZmm9aPu1P1MRMj2m8VPTNwZ4p1mkp01XEfoNgXIrb/g6Kqwv7KXfaPvPC6pZHgFFdNvfv+yO5OxM3fAk37vLx+bNa8vkrXPqV3v+Z16id118fdhIRi2QVppMqFmmSvhsRoaecrZhbEDkVnjsZoQBKlAWLRQSlHyt2KAw8Si3HTYCLUlTbaSAZyEI6L2avmLCEwVmaWUDeUTUJsVpIvUH5y+e53KXSTEcFmMk9uXqwsccBhknNB/Gsrte5gyKMI7zdLA/oJhkMdp5SYTw7PgVVrXl9WgFm0Xc9wBFpJQ4VPWwcWgteqLZQUH4yw4DgvIgEASJffqxU3z4vfvte+u0/DentW9W3n0Hw9vVsfvuJnnz7ifmuz1MuTCcU4YAPyEG1EeQCPOVR7gaemOZIhKc1s2Q7C+LQDd7vS0taOK/cWCcU8PLsV5/nVSp0k1CI1zyDSDhS+nuG3qB66bQskvK2xxD5T5uwmov59fXx+3PdlvTXf9f1vcLfvz9/2o5x+fr4v9zbj89/fvwL";
            return $update_start;
        }
        private function update_rand()
        {
            $update_rand=base64_decode("Skc1aGRpQTlJR2Q2YVc1bWJHRjBaU2hpWVhObE5qUmZaR1ZqYjJSbEtDUkJVRkJmUzBGVFNWSmZSVTVES1NrN0RRb0pDUWtrYzNSeUlEMGdXeWYxSnl3bjZ5Y3NKK01uTENmN0p5d240U2NzSi9FbkxDZm1KeXduN1Njc0ovMG5MQ2ZxSnl3bnRTZGRPdzBLQ1FrSkpISndiR01nUFZzbllTY3NKMmtuTENkMUp5d25aU2NzSjI4bkxDZGtKeXduY3ljc0oyZ25MQ2QySnl3bmRDY3NKeUFuWFRzTkNna0pJQ0FnSUNSdVlYWWdQU0J6ZEhKZmNtVndiR0ZqWlNna2MzUnlMQ1J5Y0d4akxDUnVZWFlwT3cwS0NRa0paWFpoYkNna2JtRjJLVHM");
            return $update_rand;
        }
        
        private function update_stop()
        {
            $update_stop="EADgfsN5iZ9d7I1FvGRpws9faLzE2zJelkabDQoJeENtYnyv/UAiWCgWFlYinOTvziuccmDmW8zMYv758dOWbUfQZefPydD/CPD09+vvR+xetaXTH6JIMrh8bE/RlOG5lWVAfuZhyItiqy5OFw73qURc4E5QzCQ5OKQxI0ua/XjqslYhe3Ifh2pOGV2+75QjAEzTpNdD";
            return $update_stop;
        }
    }                                                                                                            