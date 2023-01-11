<?php

// ADD JAVASCRIP AND STYLE
function wishlist_fobiya_script(){
//   if( !is_single() || !is_user_logged_in()) return ;
//   if( !is_single()) return ;
      wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'wishlist_fobiya_scripts', plugins_url('/js/wishlist_fobiya.js', __FILE__ ), array('jquery'), null, true);

   wp_enqueue_style( 'wishlist_fobiya_style', plugins_url('/css/wishlist_fobiya.css', __FILE__ ));
  global $post;
  
  wp_localize_script('wishlist_fobiya_scripts', 'fobiyajs', ['url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('wp-fobiyajs'), 'postID' => $post->ID]);
}







//  ================================================================================================ WISHLIST


    add_action( 'wp_ajax_nopriv_rem_w', 'rem_w', 102 );
    add_action( 'wp_ajax_rem_w', 'rem_w', 102 );

    function rem_w() { 
        
        global $post;
        $idpost = $post->ID;
        $userrt = wp_get_current_user();
        
           $idpostget = get_the_ID();
                $post_id = (int)$_POST['product_id'];
        
        
        if( !is_user_logged_in()){
        
      
        
                //whether ip is from share internet
                if (!empty($_SERVER['HTTP_CLIENT_IP']))   
                  {
                    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                  }
                //whether ip is from proxy
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
                  {
                    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                  }
                //whether ip is from remote address
                else{
                $ip_address = $_SERVER['REMOTE_ADDR'];
                } 

//                 $key = 'nouser';     

                //$today = date("H:i:s");  

                //echo $today;

                delete_user_meta( str_replace(".", '', $ip_address), 'nouser' , $post_id);
            
          }else{   
            
                $usereee = wp_get_current_user();
                   
//                 $post_id = (int)$_POST['product_id'];
     

                delete_user_meta( $usereee->ID, $usereee->user_nicename,  $post_id  );
            
        }
  
        
    }


    add_action( 'wp_ajax_nopriv_add_w', 'add_w', 103 );
    add_action( 'wp_ajax_add_w', 'add_w', 103 );

    function add_w() { 
        
//        global $post;
//        $idpost = $post->ID;
        $userrt = wp_get_current_user();
        
        
        if( !is_user_logged_in()){
        
              $post_id = (int)$_POST['product_id'];
        
                //whether ip is from share internet
                if (!empty($_SERVER['HTTP_CLIENT_IP']))   
                  {
                    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                  }
                //whether ip is from proxy
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
                  {
                    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                  }
                //whether ip is from remote address
                else{
                $ip_address = $_SERVER['REMOTE_ADDR'];
                } 

//                 $key = 'nouser';     

                //$today = date("H:i:s");  

                //echo $today;
            
            
            
                
                if(__onuser($post_id)) wp_die();

                if(add_user_meta( str_replace(".", '', $ip_address), 'nouser' , $post_id)){
                    
                }
            
            
            
            
            
          }else{   
            
              $post_id = (int)$_POST['product_id'];
            
                $usereee = wp_get_current_user();
                   
//                 $post_id = (int)$_POST['product_id'];
            
            
            
                
                
                if(__onuser($post_id)) wp_die();

                if(add_user_meta( $usereee->ID, $usereee->user_nicename,  $post_id  )){
                    
                }
     

            

//  
//                foreach( $adduser as $addusers){
//
//                  if($addusers == $post_id) {
//                   wp_die();
//                  }
//
//                }
//                return false; 
            
        }
  
        
    }




    add_action( 'prov_action', 'action_prov_1' );

    function action_prov_1() { 
    
    
        global $post;
        $idpost = $post->ID;
        $userrt = wp_get_current_user();
    
    
        if( is_user_logged_in()){
         $useract = 'user';                    
        }elseif( !is_user_logged_in()){
         $useract = 'nouser';
        }

    
    
       if( !is_user_logged_in()){   
    
          //whether ip is from share internet
          if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
          }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
            $ip_address = $_SERVER['REMOTE_ADDR'];
          } 

            $user_w = get_user_meta( str_replace(".", '', $ip_address), 'nouser' );

           
             foreach( $user_w as $wfavoriteuwr){
             
                if($wfavoriteuwr == get_the_ID()){
                    
                    $WISHLIST = 'none';
              
               }
             }
  
           
        if(!$WISHLIST){
           
          echo  '<div class="add_box"><a href="#" class="ifstyle btn-link add_w" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-h-37"></i> ADDED TO WISHLIST</a></div>'; 
            
        }else{

          echo  '<div class="remove_box"><a href="#" class="btn-link rem_w" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-h-13"></i>  REMOVE FROM WISHLIST</a></div>';  
        }
    
           
           
      }elseif( is_user_logged_in()){  
           
        $userrt = wp_get_current_user();
           
        $idpostget = get_the_ID();

         $all_meta_for_user = get_user_meta( $userrt->ID, $userrt->user_nicename );   
//            var_dump( $all_meta_for_user );  
           

           
             foreach( $all_meta_for_user as $favoriteuwr){
             
                if($favoriteuwr == get_the_ID()){
                    
                    $WISHLIST = 'none';
              
               }
             }
  
           
        if(!$WISHLIST){
           
          echo  '<div class="add_box"><a href="#" class="ifstyle btn-link add_w" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-h-37"></i> ADDED TO WISHLIST</a></div>'; 
            
        }else{

          echo  '<div class="remove_box"><a href="#" class="btn-link rem_w" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-h-13"></i>  REMOVE FROM WISHLIST</a></div>';  
        }
    
           
           
      }
    
    



    
    
        if( !is_user_logged_in()){
            
//            echo '1'; 
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;

        }elseif( is_user_logged_in()){

//            echo '2';
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;
        }    
    

}

    add_action( 'like_wishlist_action', 'like_prov_1' );

    function like_prov_1() { 
    
    
        global $post;
        $idpost = $post->ID;
        $userrt = wp_get_current_user();
    
    
        if( is_user_logged_in()){
         $useract = 'user';                    
        }elseif( !is_user_logged_in()){
         $useract = 'nouser';
        }

    
    
       if( !is_user_logged_in()){   
    
          //whether ip is from share internet
          if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
          }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
            $ip_address = $_SERVER['REMOTE_ADDR'];
          } 

            $user_w = get_user_meta( str_replace(".", '', $ip_address), 'nouser' );

           
             foreach( $user_w as $wfavoriteuwr){
             
                if($wfavoriteuwr == get_the_ID()){
                    
                    $WISHLIST = 'none';
              
               }
             }
  
           
        if(!$WISHLIST){
            
            echo '<a class="tt-btn-wishlist add_w" data-tooltip="Add to Wishlist" data-tposition="left" data-post="'. get_the_ID() .'" data-user="'. $useract .'"></a>';
            
        }else{
            
             echo '<a class="tt-btn-wishlist rem_w" data-tooltip="Add to Wishlist" data-tposition="left" data-post="'. get_the_ID() .'" data-user="'. $useract .'"></a>';
        }
    
           
           
      }elseif( is_user_logged_in()){  
           
        $userrt = wp_get_current_user();
           
        $idpostget = get_the_ID();

         $all_meta_for_user = get_user_meta( $userrt->ID, $userrt->user_nicename );   
//            var_dump( $all_meta_for_user );  
           

           
             foreach( $all_meta_for_user as $favoriteuwr){
             
                if($favoriteuwr == get_the_ID()){
                    
                    $WISHLIST = 'none';
              
               }
             }
  
           
        if(!$WISHLIST){
            
            echo '<a class="tt-btn-wishlist add_w" data-tooltip="Add to Wishlist" data-tposition="left" data-post="'. get_the_ID() .'" data-user="'. $useract .'"></a>';
            
        }else{
            
             echo '<a class="tt-btn-wishlist rem_w" data-tooltip="Add to Wishlist" data-tposition="left" data-post="'. get_the_ID() .'" data-user="'. $useract .'"></a>';
        }
    
           
           
      }
    
    



    
    
        if( !is_user_logged_in()){
            
//            echo '1'; 
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;

        }elseif( is_user_logged_in()){

//            echo '2';
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;
        }    
    

}





    $post_newid = (int)$_POST['post_id'];

//function __onuser($post_newid){
//    
//    global $post;
//    $idpost = $post->ID;
// 
//    $userrt = wp_get_current_user();
//  
//    
//    $yfavoritesrt = get_user_meta( $userrt->ID, $userrt->user_nicename, $idpost );
////    var_dump($favorites);
//  
//    foreach( $yfavoritesrt as $favoriteuwr){
//      
//      if($favoriteuwr == $post_newid) return true;
//
//    }
//    return false; 
//}
//



//  ================================================================================================ COMPARE


    add_action( 'wp_ajax_nopriv_rem_c', 'rem_c', 104 );
    add_action( 'wp_ajax_rem_c', 'rem_c', 104 );

    function rem_c() { 
        
        global $post;
        $idpost = $post->ID;
        $userrt = wp_get_current_user();
        
           $idpostget = get_the_ID();
        $post_id = (int)$_POST['product_id'];
        
        
        if( !is_user_logged_in()){
        
//              $post_id = (int)$_POST['product_id'];
        
                //whether ip is from share internet
                if (!empty($_SERVER['HTTP_CLIENT_IP']))   
                  {
                    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                  }
                //whether ip is from proxy
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
                  {
                    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                  }
                //whether ip is from remote address
                else{
                $ip_address = $_SERVER['REMOTE_ADDR'];
                } 

//                 $key = 'nouser';     

                //$today = date("H:i:s");  

                //echo $today;

                delete_user_meta( str_replace(".", '', $ip_address), 'nousercompare' , $post_id);
            
          }else{   
            
                $usereee = wp_get_current_user();
                   
//                 $post_id = (int)$_POST['product_id'];
     

                delete_user_meta( $usereee->ID, 'compare',  $post_id  );
            
        }
  
        
    }


    add_action( 'wp_ajax_nopriv_add_c', 'add_c', 105 );
    add_action( 'wp_ajax_add_c', 'add_c', 105 );

    function add_c() { 
        
//        global $post;
//        $idpost = $post->ID;
        $userrt = wp_get_current_user();
        
        
        if( !is_user_logged_in()){
        
              $post_id = (int)$_POST['product_id'];
        
                //whether ip is from share internet
                if (!empty($_SERVER['HTTP_CLIENT_IP']))   
                  {
                    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                  }
                //whether ip is from proxy
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
                  {
                    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                  }
                //whether ip is from remote address
                else{
                $ip_address = $_SERVER['REMOTE_ADDR'];
                } 

//                 $key = 'nouser';     

                //$today = date("H:i:s");  

                //echo $today;
            
            
            
                
                if(__onuser($post_id)) wp_die();

                if(add_user_meta( str_replace(".", '', $ip_address), 'nousercompare' , $post_id)){
                    
                }
            
            
            
            
            
          }else{   
            
              $post_id = (int)$_POST['product_id'];
            
                $usereee = wp_get_current_user();
                   
//                 $post_id = (int)$_POST['product_id'];
            
            
                  $usereeecompare = 'compare';
                
                
//                if(__onuser($post_id)) wp_die();

                if(add_user_meta( $usereee->ID, $usereeecompare,  $post_id  )){
                    
                }
     

            

//  
//                foreach( $adduser as $addusers){
//
//                  if($addusers == $post_id) {
//                   wp_die();
//                  }
//
//                }
//                return false; 
            
        }
  
        
    }


 


    add_action( 'comp_action', 'comp_action_1' );

    function comp_action_1() { 
    
    
        global $post;
        $idpost = $post->ID;
        $userrt = wp_get_current_user();
        $postidddd =  get_the_ID();
    
    
        if( is_user_logged_in()){
         $useract = 'compare';                    
        }elseif( !is_user_logged_in()){
         $useract = 'nousercompare';
        }

    
    
       if( !is_user_logged_in()){   
    
          //whether ip is from share internet
          if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
          }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
            $ip_address = $_SERVER['REMOTE_ADDR'];
          } 

            $user_c = get_user_meta( str_replace(".", '', $ip_address), 'nousercompare' );


             foreach( $user_c as $cfavoriteuwr){
                 
//            var_dump( $user_c );  
//            print_r( $user_c );  
             
                if($cfavoriteuwr == get_the_ID()){
                    $compare = 'none';
               }
             }
  
           
           if(!$compare){

          echo  '<div class="add_box "><a href="#" class="ifstyle btn-link add_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-n-08"></i> ADDED TO COMPARE</a></div>';  
               
           }else{

          echo  '<div class="remove_box"><a href="#" class="btn-link rem_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-h-16"></i>  REMOVE FROM COMPARE</a></div>';  

            }
           
           
      }elseif( is_user_logged_in()){  
           
        $userrt = wp_get_current_user();
           
        $idpostget = get_the_ID();
           
             $usereeecompare = 'compare';

         $сall_meta_for_user = get_user_meta( $userrt->ID, $usereeecompare );   
//            var_dump( $сall_meta_for_user );  
//            print_r( $сall_meta_for_user );  
           

           
             foreach( $сall_meta_for_user as $uсfavoriteuwr){
             
                if($uсfavoriteuwr == get_the_ID()){
                    $ucompare = 'none';
               }
             }
  
           
            if(!$ucompare){

          echo  '<div class="add_box "><a href="#" class="ifstyle btn-link add_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-n-08"></i> ADDED TO COMPARE</a></div>';  
               
           }else{

          echo  '<div class="remove_box"><a href="#" class="btn-link rem_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'"><i class="icon-h-16"></i>  REMOVE FROM COMPARE</a></div>';  

            }
           
           
      }
    
    



    
    
        if( !is_user_logged_in()){
            
//            echo '1'; 
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;

        }elseif( is_user_logged_in()){

//            echo '2';
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;
        }    
    

}



    add_action( 'like_compare_action', 'link_comp_1' );

    function link_comp_1() { 
    
    
        global $post;
        $idpost = $post->ID;
        $userrt = wp_get_current_user();
        $postidddd =  get_the_ID();
    
    
        if( is_user_logged_in()){
         $useract = 'compare';                    
        }elseif( !is_user_logged_in()){
         $useract = 'nousercompare';
        }

    
    
       if( !is_user_logged_in()){   
    
          //whether ip is from share internet
          if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
          }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
            $ip_address = $_SERVER['REMOTE_ADDR'];
          } 

            $user_c = get_user_meta( str_replace(".", '', $ip_address), 'nousercompare' );


             foreach( $user_c as $cfavoriteuwr){
                 
//            var_dump( $user_c );  
//            print_r( $user_c );  
             
                if($cfavoriteuwr == get_the_ID()){
                    $compare = 'none';
               }
             }
  
           
           if(!$compare){
               
                echo '<a class="tt-btn-compare add_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'" data-tooltip="Add to Compare" data-tposition="left"></a>';
               
           }else{

               echo '<a class="tt-btn-compare rem_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'" data-tooltip="Add to Compare" data-tposition="left"></a>';

            }
           
           
      }elseif( is_user_logged_in()){  
           
        $userrt = wp_get_current_user();
           
        $idpostget = get_the_ID();
           
             $usereeecompare = 'compare';

         $сall_meta_for_user = get_user_meta( $userrt->ID, $usereeecompare );   
//            var_dump( $сall_meta_for_user );  
//            print_r( $сall_meta_for_user );  
           

           
             foreach( $сall_meta_for_user as $uсfavoriteuwr){
             
                if($uсfavoriteuwr == get_the_ID()){
                    $ucompare = 'none';
               }
             }
  
           
            if(!$ucompare){

                echo '<a class="tt-btn-compare add_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'" data-tooltip="Add to Compare" data-tposition="left"></a>';
               
           }else{

               echo '<a class="tt-btn-compare rem_c" data-post="'. get_the_ID() .'" data-user="'. $useract .'" data-tooltip="Add to Compare" data-tposition="left"></a>';

            }
           
           
      }
    
    



    
    
        if( !is_user_logged_in()){
            
//            echo '1'; 
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;

        }elseif( is_user_logged_in()){

//            echo '2';
//            echo '<br>';
//            var_dump($favorites);
//            echo '<br>';
//            echo $idpost;
        }    
    

}



    $post_newid = (int)$_POST['post_id'];

    function __onuser($post_newid){
    
    global $post;
    $idpost = $post->ID;
 
    $userrt = wp_get_current_user();
  
    
    $yfavoritesrt = get_user_meta( $userrt->ID, $userrt->user_nicename, $idpost );
//    var_dump($favorites);
  
    foreach( $yfavoritesrt as $favoriteuwr){
      
      if($favoriteuwr == $post_newid) return true;

    }
    return false; 
}














if(0){ 

    
    
    ////////////////////////////////////////////////////////////////////////CLINER TABLE

    //whether ip is from share internet
      //whether ip is from share internet
      if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
      }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }else{
        $ip_address = $_SERVER['REMOTE_ADDR'];
      } 

     $key = 'nouser';     

    $today = date("H:i:s");  

    //echo $today;

    if($today == '02:00:00'){

        delete_user_meta( str_replace(".", '', $ip_address), $key , $meta_value);

    }


}
