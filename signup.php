<?php  
// $_POST['role'] = "";
// $_POST['email'] = "";
 
        require_once 'db.php';

        $con = createDB();

        

        $role = "";
        $name = "";
        $email = "";    
        $pass = "";
        $phone = "";
        $address = "";
        $dob = "";
        $photo = "";
        
      

        $formError="";
        $roleError = "";
        $nameError = "";
        $emailError = "";
        $passError = "";
        $phoneError = "";
        $addressError = "";
        $dobError = "";
        $photoError = "";
        $inputempty ="";
        
       
        if(isset($_POST['submit'])){
          $error = mysqli_error($GLOBALS['con']);
            // $photo = $_FILES['photo'];
            // print_r($_FILES['photo']);
            
            if(empty($_POST['role'])){
              $roleError = "*role error";
            }
            if(empty($_POST['email'])){
              $emailError = "*Email error";
            }
            if(empty($_POST['phone'])){
              $phoneError = "*Phone error";
            }
            if(empty($_POST['address'])){
              $addressError = "*Address error";
            }
            if(empty($_POST['name'])){
              $nameError = "*Name error";
            }
            
            if(empty($_POST['pass'])){
              $passError = "*Password error";
            }
            if(empty($_POST['photo'])){
              $photoError = "*Photo error";
            }
            if(empty($_POST['dob'])){
              $dobError = "*DOB error";
            }
            if( empty($_POST['role']) &&  empty($_POST['email']) && empty($_POST['phone']) &&  empty($_POST['address']) && empty($_POST['name']) &&  empty($_POST['pass']) && empty($_POST['photo']) &&  empty($_POST['dob'])  ){
              $formError = "
            <div class='container'>
            <h6 class='bg-danger text-light text-center rounded py-3'>Form has Error!</h6></div>

            ";
            echo $formError;
            }
            
            // elseif(){
              
              
            //     // echo "<script>alert('Insert error! Email already Exists');</script>";
            //     $formError = "
            // <div class='container'>
            // <h6 class='bg-danger text-light text-center rounded py-3'>Insert error! Email already Exists</h6></div>

            // ";
            // echo $formError;
              
            // }
            else{
              createData(); 
            }
            


            
        }
      
        function createData(){
          
            $role = checkinput('role');
            $name = checkinput('name');
            $email = checkinput('email');
            $pass = checkinput('pass');
            $phone = checkinput('phone');
            $address = checkinput('address');
            $dob = checkinput('dob');
            
            $photo = $_FILES['photo']['name'];
            $photoname = $_FILES['photo']['name'];
            $destinatin = 'upload img/'.$photoname;
            move_uploaded_file($_FILES['photo']['tmp_name'],$destinatin);
            // print_r($_FILES['photo']);
            // if($_POST['role'] == ""){
            //   echo "role empty";
            // }
            
            
            // $photo = $_POST['photo'];

            // if(empty($role)){
            //   $roleError = "role empty";
            //   echo $roleError;
            // }



            $emailquery = mysqli_query($GLOBALS['con'] , "SELECT * FROM `account7` WHERE email = '$email' ");
            if(mysqli_num_rows($emailquery) > 0){
              $formError = "
              <div class='container'>
              <h6 class='bg-danger text-light text-center rounded py-3'>Email already Exists!</h6></div>
  
              ";
              echo $formError;
            }

          elseif($role && $name && $email && $pass && $phone && $address && $dob && $photo ){

            $sql = "
            insert into account7(role,name,email,pass,phone,address,dob,photo)
            values('$role','$name','$email','$pass','$phone','$address','$dob','$photo')
            
            ";

            if(mysqli_query($GLOBALS['con'],$sql) ){
              
                echo "<script>alert('Registration Success!');</script>";
                if($role == "teacher"){
                  echo "<script>alert('Choosed Teacher');</script>";
                  // header('Location:teacher_dash 111.html');
                }
                else{
                  echo "<script>alert('Choosed Student');</script>";
                  // header('Location:student_dash.html');
                  
                }
                // header('Location:signin.php');

            }
            else{
              
              $error = mysqli_error($GLOBALS['con']);
              if(!empty($error)){
                // echo "<script>alert('Insert error! Email already Exists');</script>";
                $formError = "
            <div class='container'>
            <h6 class='bg-danger text-light text-center rounded py-3'>Insert error! Email already Exists</h6></div>

            ";
            echo $formError;
              }
            }
            // else (mysqli_query($GLOBALS['con'],$sql) && $role = "student"){
            //     echo "<script>alert('Student Registration Success!');</script>";
            //   }
            // if($role = "teacher"){
            //   header('Location:teacher_dash.html');
            // }
            // else if($role = "student"){
            //   header('Location:student_dash.html');
            // }
          
          }
          
          

          // if($role = "student"  && $name && $email && $pass ){
          //     echo "<script>alert('Choosed student');</script>";

          //     if(mysqli_query($GLOBALS['con'],$sql)){
          //       echo "<script>alert('Student Registration Success!');</script>";
  
          //     }
          //     else{
          //       echo "<script>alert('Insert error!');</script>";
  
          //     }
          // }
          else{
            //  echo "<script>alert('Empty!');</script>";
            $formError = "
            <div class='container'>
            <h6 class='bg-danger text-light text-center rounded py-3'>Form has Error!</h6></div>

            ";
            echo $formError;
            // function emptyError(){
            //   $inputempty = "Input are Empty";
            //   $message = "
            //   <h6 class='bg-danger text-light text-center rounded py-3'>Input Empty!</h6>
            //   ";
            //   echo $message;
            // }
          }
          
        }



          function checkinput($value){
            // $_POST['role']='';
            if(isset($_POST['role'])){
            $inputvalue = mysqli_real_escape_string($GLOBALS['con'],trim($_POST[$value]));

              if(empty($inputvalue)){
                return false;
              }
              else{
                return $inputvalue;
                
              }}
          }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <title>Sky Castle</title>
   <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="library/bootstrap/bootstrap.min.css"> -->
    <link rel="stylesheet" href="style.css">
    <style>
      @media only screen and (max-width: 768px) {
        body,html {
        overflow-x:hidden;
        }
      }

      body{
        background: rgb(238,174,202);
        background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(87,141,204,1) 100%);
      }
      /* .bgt{
          background-color: rgba(0, 0, 0, 0.1);
      } */
    </style>
</head>
<body>
  <div class="container">
  
    <h2 class="text-light text-center mt-3 mb-5">Register | Create Account</h2>
      <div class="row mt-5">
        <div class="col-md-6 text-center text-primary ">
      
           <svg id="e1d695e9-8964-4787-9b74-7d5c46f50f25" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="531.27654" height="538.57692" viewBox="0 0 531.27654 538.57692"><path d="M558.34481,428.93851l191.82462-.34238a1.29285,1.29285,0,0,0,0-2.5857l-191.82462.34238a1.29285,1.29285,0,0,0,0,2.5857Z" transform="translate(-334.36173 -180.71154)" fill="#3f3d56"/><circle cx="221.11744" cy="248.22696" r="18.09988" fill="#3f3d56"/><path d="M741.57064,428.8468A124.06763,124.06763,0,1,1,865.63827,304.77917,124.2081,124.2081,0,0,1,741.57064,428.8468Zm0-239.57887A115.51124,115.51124,0,1,0,857.08188,304.77917,115.64258,115.64258,0,0,0,741.57064,189.26793Z" transform="translate(-334.36173 -180.71154)" fill="#3f3d56"/><path d="M795.10421,354.49076a22.96043,22.96043,0,1,1,22.94537-22.97622A22.97121,22.97121,0,0,1,795.10421,354.49076Zm-53.53394,0a22.971,22.971,0,0,1-22.94463-22.94462V278.0122a22.945,22.945,0,0,1,45.89,0v53.53394A22.9712,22.9712,0,0,1,741.57027,354.49076Zm-53.51814,0a22.9871,22.9871,0,0,1-22.96043-22.96117V310.141a22.9608,22.9608,0,0,1,45.9216,0v21.3886A22.98725,22.98725,0,0,1,688.05213,354.49076Z" transform="translate(-334.36173 -180.71154)" fill="#6c63ff"/><path d="M367.79318,608.64146v2.08078a13.01619,13.01619,0,0,0,13.00489,13.00488H491.0795a13.00967,13.00967,0,0,0,13.00488-13.00488v-2.08078a12.91153,12.91153,0,0,0-3.01754-8.32313,13.37876,13.37876,0,0,0-2.19508-2.08078H441.67109a2.602,2.602,0,0,1-2.601-2.601h-58.272A13.02293,13.02293,0,0,0,367.79318,608.64146Z" transform="translate(-334.36173 -180.71154)" fill="#3f3d56"/><rect x="428.66103" y="623.21048" width="13.52508" height="95.71596" transform="translate(536.48542 1161.42537) rotate(-180)" fill="#3f3d56"/><path d="M390.16657,718.4513c0,1.46136,20.49515.56525,45.7772.56525s45.7772.89611,45.7772-.56525-20.49515-13.04994-45.7772-13.04994S390.16657,716.98993,390.16657,718.4513Z" transform="translate(-334.36173 -180.71154)" fill="#3f3d56"/><path d="M389.01706,606.44625l46.15159,7.366,53.62179,8.5624,18.5919,2.96515a6.82584,6.82584,0,0,0,7.80293-5.65973l.84278-5.26437.78029-4.90027.64466-4.03672a6.74859,6.74859,0,0,0-1.28982-5.16036,6.58737,6.58737,0,0,0-2.52833-2.08078H441.67109a2.602,2.602,0,0,1-2.601-2.601V593.587a2.602,2.602,0,0,1,2.601-2.601h28.278l-13.03638-2.08078-40.07588-6.39843-23.39812-3.735A6.84,6.84,0,0,0,385.615,584.442l-2.26824,14.19088A6.8532,6.8532,0,0,0,389.01706,606.44625Z" transform="translate(-334.36173 -180.71154)" fill="#6c63ff"/><path d="M488.79044,604.46954v79.28815a6.82444,6.82444,0,0,0,6.81435,6.81455h14.38869a6.82455,6.82455,0,0,0,6.81486-6.81455V604.46954a6.72634,6.72634,0,0,0-1.42545-4.15121,6.57659,6.57659,0,0,0-2.64264-2.08078H492.84786a6.61324,6.61324,0,0,0-2.632,2.08078A6.74553,6.74553,0,0,0,488.79044,604.46954Z" transform="translate(-334.36173 -180.71154)" fill="#6c63ff"/><path d="M445.42676,470.26947a6.86555,6.86555,0,0,0,.541,2.04961,6.71737,6.71737,0,0,0,1.94565,2.549l.0315.02076,41.05378,33.30292.603.47861,8.50042,6.89779,2.56948,2.08078H545.1275l-2.55932-2.08078-35.134-28.50673-23.54392-19.10156L465.5691,453.103a6.74725,6.74725,0,0,0-3.76634-1.49817.03285.03285,0,0,0-.02083-.01035,6.91665,6.91665,0,0,0-1.22784.02076,6.55522,6.55522,0,0,0-1.779.437,5.00764,5.00764,0,0,0-1.10288.56179,6.57056,6.57056,0,0,0-1.69571,1.48775l-8.92664,10.99694-.13513.17685A6.76359,6.76359,0,0,0,445.42676,470.26947Z" transform="translate(-334.36173 -180.71154)" fill="#6c63ff"/><path d="M447.94494,474.88881a16.86836,16.86836,0,0,0,3.31878,5.2332l27.33109,29.3598a6.81393,6.81393,0,0,0,9.64393-.42653l.76-.86355.33274-.37452L501.14,494.57305l5.077-5.70138a5.98862,5.98862,0,0,0,.87377-1.16523c.125-.2081.23927-.42654.34341-.645a6.90123,6.90123,0,0,0,.572-3.08993,6.72257,6.72257,0,0,0-2.23674-4.7546l-31.69026-24.22033a16.97312,16.97312,0,0,0-12.27641-3.39168.03285.03285,0,0,0-.02083-.01035,17.8419,17.8419,0,0,0-2.87174.60338c-.41606.11449-.82144.2601-1.238.41618a16.76888,16.76888,0,0,0-6.91849,4.88985,16.98688,16.98688,0,0,0-2.80875,17.38489Z" transform="translate(-334.36173 -180.71154)" fill="#2f2e41"/><circle cx="100.60558" cy="194.56731" r="52.14653" fill="#6c63ff"/><path d="M421.08172,599.25717l19.3407,3.07952.43739.07284,29.4012,4.69217,18.52943,2.96515,27.23761,4.34883.78029.12484,4.04676.645,18.59191,2.96508a6.82557,6.82557,0,0,0,7.80293-5.65972l1.62307-10.15423.64516-4.03672c0-.02077.01016-.04159.01016-.06242H441.67109a2.602,2.602,0,0,1-2.601-2.601V593.587a2.602,2.602,0,0,1,2.601-2.601h34.083V579.61459l-2.08078-.33293-10.27894-1.64384-37.90111-6.04467a6.82836,6.82836,0,0,0-7.8136,5.65973l-.84278,5.254-1.42545,8.9474A6.83354,6.83354,0,0,0,421.08172,599.25717Z" transform="translate(-334.36173 -180.71154)" fill="#6c63ff"/><path d="M363.99535,553.18864c0,42.51035,4.318,67.93751,70.903,60.65477.09348-.01035.17679-.02076.27026-.03118A197.70531,197.70531,0,0,0,470.261,607.1017a104.21954,104.21954,0,0,0,17.31225-6.78337c1.31065-.6658,2.56948-1.36291,3.808-2.08078H441.67109a2.602,2.602,0,0,1-2.601-2.601V593.587a2.602,2.602,0,0,1,2.601-2.601h34.083V525.275a7.63712,7.63712,0,0,1,7.62615-7.62609H511.107c-.23977-.68669-.47854-1.38373-.73863-2.08078A170.44737,170.44737,0,0,0,501.14,494.57305a160.14979,160.14979,0,0,0-17.24976-26.61321A110.83481,110.83481,0,0,0,468.451,452.1563c-10.43541-8.61447-21.79639-13.94126-33.324-13.94126C392.61677,438.215,363.99535,510.67828,363.99535,553.18864Z" transform="translate(-334.36173 -180.71154)" fill="#2f2e41"/><path d="M433.8717,394.6061l-.05424-1.94871c3.62528-.10086,6.82142-.32827,9.22305-2.08287a5.99028,5.99028,0,0,0,2.32027-4.41218,3.42421,3.42421,0,0,0-1.12326-2.82029c-1.59427-1.3464-4.15955-.9106-6.02928-.05329l-1.61235.73933,3.09195-22.59565,1.93063.26452-2.63,19.22062c2.54055-.74694,4.8946-.42532,6.50694.9363a5.33064,5.33064,0,0,1,1.81264,4.377,7.92406,7.92406,0,0,1-3.11812,5.91748C441.10418,394.40342,437.094,394.5157,433.8717,394.6061Z" transform="translate(-334.36173 -180.71154)" fill="#2f2e41"/><rect x="116.80473" y="182.64296" width="10.49522" height="1.94871" fill="#2f2e41"/><rect x="83.67674" y="182.64296" width="10.49522" height="1.94871" fill="#2f2e41"/><path d="M393.35,360.95121c4.05558-6.10489,11.1917-8.69271,18.22866-9.32223,7.92065-.70857,15.57408.81879,23.30735,2.30272,8.51085,1.63314,17.51826,3.16112,26.094,1.09634a25.72367,25.72367,0,0,0,17.486-14.126,32.90492,32.90492,0,0,0,1.91582-21.94056c-2.00958-7.78144-6.99769-14.6284-13.04462-19.79989-12.34188-10.55508-29.04355-15.29872-45.10765-14.8519A76.26171,76.26171,0,0,0,378.01866,299.855a71.80705,71.80705,0,0,0-25.47438,39.92083,74.85818,74.85818,0,0,0,3.62494,47.08463c3.51529,8.15472,8.59934,15.50645,12.52238,23.45581,3.65261,7.40139,6.46562,16.00665,4.19294,24.26214-1.99424,7.24405-7.84918,13.67974-15.19949,15.64649a15.96133,15.96133,0,0,1-17.74939-7.246c-3.6744-5.794-3.76231-13.38285,1.75458-18.061a13.54194,13.54194,0,0,1,19.53576,1.94938,13.93934,13.93934,0,0,1,2.78829,10.22012c-.27178,1.84013,2.54435,2.63425,2.81865.77707a16.489,16.489,0,0,0-30.74383-10.647c-3.327,6.25528-1.53188,13.80016,2.69141,19.1471a18.66224,18.66224,0,0,0,19.02765,6.84224c7.68755-1.77543,13.97638-7.88546,16.93383-15.06543,3.29251-7.99339,1.784-16.91343-1.42571-24.67-3.46958-8.38461-8.62187-15.90439-12.69639-23.98426a68.30772,68.30772,0,0,1-6.9312-23.33853,73.84721,73.84721,0,0,1,10.53213-46.77613,68.63472,68.63472,0,0,1,37.80339-28.7307c15.4-4.83417,32.38475-4.68612,47.46329,1.255,14.85277,5.85216,29.19486,18.60579,29.02264,35.73472-.07356,7.31688-2.78975,14.77871-8.39429,19.659-6.69786,5.83236-16.02377,6.33094-24.44347,5.4207-8.47311-.916-16.70125-3.39053-25.21093-4.02178-7.40161-.549-15.38683.02176-21.99557,3.69907a21.992,21.992,0,0,0-7.63988,7.08735c-1.04386,1.57134,1.48671,3.03673,2.524,1.47532Z" transform="translate(-334.36173 -180.71154)" fill="#2f2e41"/><path d="M401.64754,488.58039a5.48412,5.48412,0,0,0,.28042.55138,5.91309,5.91309,0,0,0,.34341.541l22.80529,32.82432,1.76886,2.549L445.44759,551.805l17.94674,25.83286,7.26191,10.46633a6.06568,6.06568,0,0,0,.65583.80112,6.79488,6.79488,0,0,0,4.255,2.08078h.18694V546.34291l-2.08078-2.99633-23.33564-33.58385L425.27478,473.6924a6.82864,6.82864,0,0,0-9.48849-1.71667l-7.68863,5.33721-4.13057,2.87149A6.81449,6.81449,0,0,0,401.64754,488.58039Z" transform="translate(-334.36173 -180.71154)" fill="#6c63ff"/><path d="M398.07882,487.77927l1.02972,2.07037.01067.01041.28093.55144L416.119,523.59992a6.83863,6.83863,0,0,0,9.37419,2.28887l1.082-.67628.27025-.16643L448.40265,511.521a6.81158,6.81158,0,0,0,2.26772-9.40511l-23.67905-32.10651a17.01963,17.01963,0,0,0-20.787-5.36839,16.73873,16.73873,0,0,0-2.30989,1.26924A17.02386,17.02386,0,0,0,398.07882,487.77927Z" transform="translate(-334.36173 -180.71154)" fill="#2f2e41"/><path d="M520.8551,598.23755v78.33107a6.82455,6.82455,0,0,0,6.81486,6.81454h14.38869a6.82444,6.82444,0,0,0,6.81436-6.81454V598.23755Z" transform="translate(-334.36173 -180.71154)" fill="#6c63ff"/><path d="M436.98934,593.587v2.04954a4.69851,4.69851,0,0,0,3.76633,4.59857c.14529.02077.29109.052.43688.06243.156.01041.31192.02076.47854.02076H602.05791a9.71941,9.71941,0,0,0,9.71709-9.7068V525.275a9.71942,9.71942,0,0,0-9.71709-9.70687H483.3802a9.71759,9.71759,0,0,0-9.70693,9.70687v63.63027H441.67109A4.682,4.682,0,0,0,436.98934,593.587Z" transform="translate(-334.36173 -180.71154)" fill="#fff"/><path d="M436.98934,593.587v2.04954a4.69851,4.69851,0,0,0,3.76633,4.59857c.14529.02077.29109.052.43688.06243.156.01041.31192.02076.47854.02076H602.05791a9.71941,9.71941,0,0,0,9.71709-9.7068V525.275a9.71942,9.71942,0,0,0-9.71709-9.70687H483.3802a9.71759,9.71759,0,0,0-9.70693,9.70687v63.63027H441.67109A4.682,4.682,0,0,0,436.98934,593.587Zm2.08078,2.04954V593.587a2.602,2.602,0,0,1,2.601-2.601h34.083V525.275a7.63712,7.63712,0,0,1,7.62615-7.62609H602.05791a7.63928,7.63928,0,0,1,7.63631,7.62609v65.33653a7.63926,7.63926,0,0,1-7.63631,7.626H441.67109A2.602,2.602,0,0,1,439.07012,595.63657Z" transform="translate(-334.36173 -180.71154)" fill="#3f3d56"/><circle cx="208.36131" cy="377.23273" r="8.00075" fill="#6c63ff"/><rect x="139.34304" y="409.29654" width="2.08078" height="9.36352" fill="#3f3d56"/></svg>


        </div>
        <div class="col-md-6 bg-light rounded py-5 px-5 " style="box-shadow: 0px 0px 20px 0px #676767;">

                <form action="signup.php"method="post" enctype="multipart/form-data">
                
                  <div class="row">
                    <div class="col-6">
                      <div class="mb-3">
                        <label for="" class="form-label">Choose One</label>
                        <span class="text-danger"><?php echo $roleError; ?></span>
                        <select name="role" class="form-select" aria-label="Default select example" >
                          <option  value="" disabled selected>Choose option</option>
                          
                          <option <?php if(empty($_POST['role']) ){echo "";} elseif($_POST['role'] == 'teacher'){ echo 'selected';} ?>  name="teacher" value="teacher">Teacher</option>
                          <option <?php if(empty($_POST['role']) ){echo "";} elseif($_POST['role'] == 'student'){ echo 'selected';} ?>  name="student" value="student">Student</option>
                          
                        </select>
                       
                      </div>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <span class="text-danger"><?php echo $emailError; ?></span>
                     
                      <input value="<?php if(empty($_POST['email'])){ echo "";} else{echo $_POST['email'];} ?>"   placeholder="Email" name="email"   type="email" class=" form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      
                      
                      
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Phone</label>
                      <span class="text-danger"><?php echo $phoneError; ?></span>
                      <input value="<?php if(empty($_POST['phone'])){ echo "";} else{echo $_POST['phone'];} ?>"   placeholder="Phone" name="phone"   type="tel" class="form-control" id="exampleInputPhone">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Address</label>
                      <span class="text-danger"><?php echo $addressError; ?></span>
                      <input value="<?php if(empty($_POST['address'])){ echo "";} else{echo $_POST['address'];} ?>"   placeholder="Address" name="address"   type="text" class=" form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      
                    </div>
                    
                    <!-- <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                   </div>
                    <div class="col-6"><div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <span class="text-danger"><?php echo $nameError; ?></span>
                      <input value="<?php if(empty($_POST['name'])){ echo "";} else{echo $_POST['name'];} ?>"   placeholder="Name" name="name"   type="text" class=" form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <span class="text-danger"><?php echo $passError; ?></span>
                      <input value="<?php if(empty($_POST['pass'])){ echo "";} else{echo $_POST['pass'];} ?>"   placeholder="Password" name="pass"   type="password" class=" form-control" id="exampleInputPassword1">
                    </div>
                    
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Photo</label>
                      <span class="text-danger"><?php echo $photoError; ?></span>
                      <input  value="gfg"  class="form-control" name="photo" type="file" id="formFile">
                     
                    </div>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Date of Birth</label>
                      <span class="text-danger"><?php echo $dobError; ?></span>
                      <div class='input-group date' id='datetimepicker1'>
                        <input value="<?php if(empty($_POST['dob'])){ echo "";} else{echo $_POST['dob'];} ?>" type='date' name="dob" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                    </div>
                    
    </div>
                  </div>


                
                <div class="row">
                  <div class="col-6 mt-5"><button type="submit" name="submit" class="btn btn-primary">Create Account</button></div>
                  <div class="col-6 mt-5"><a href="signin.php" class=" text-muted" style="text-decoration: none;">Already have an account?</a></div>
                
                
                
                
                </div>
              </form>
        </div>
      </div>

   

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
