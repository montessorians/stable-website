    <?php
    session_start();
    include("../../_system/secure.php");
        if(empty($_GET['from'])){
            if(empty($_SERVER['HTTP_REFERER'])){
                $from = "../../";
            } else {
                $from = $_SERVER['HTTP_REFERER'];
            }} else {
            $from = $_GET['from'];
        }
        if($_SESSION['account_type'] == "admin"){} else {
            if($_SESSION['account_type'] == "developer"){} else {
                    header("Location: $from");
            }
        }
        
        include("../../_system/config.php");
        include("../../_system/database/db.php");
        $db_subject = new DBase("subject", "../../_store");

        $grade_list = array(
            "Nursery","Nursery 1","Nursery 2",
            "Kindergarten", "Kindergarten 1", "Kindergarten 2",
            "Preparatory", "Preparatory 1", "Preparatory 2",
            "Grade 1", "Grade 2", "Grade 3", "Grade 4",
            "Grade 5", "Grade 6", "Grade 7", "Grade 8",
            "Grade 9", "Grade 10", "Grade 11", "Grade 12",
            "Tutorial", "Free Classes", "Online Classes",
            "Multilevel", "Training", "Seminar" 
            );

        $activity_title = "Edit Subject";
        $url = "../../action/registrar/edit_subject.php";
        $subject_id = 0;
        $button = "Edit";
        $subject_title = "";
        $subject_description = "";
        $grade = "";
        $subject_code = "";
        $units = "";

        if(empty($_GET['subject_id'])){
            $activity_title = "Create a Subject";	
            $button = "Create";
            $url = "../../action/registrar/create_subject.php";
        } else {
            $subject_id = $_GET['subject_id'];
            $subject_id = $db_subject->get("subject_id", "subject_id", "$subject_id");
            if(empty($subject_id)){
                header("Location: ../../");
            }
        }
        
        $subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");
        $subject_description = $db_subject->get("subject_description", "subject_id", "$subject_id");
        $grade = $db_subject->get("grade", "subject_id", "$subject_id");
        $subject_code = $db_subject->get("subject_code", "subject_id", "$subject_id");
        $units = $db_subject->get("units", "subject_id", "$subject_id");

    ?>
    <!Doctype html>
    <html>
        <head>
            <title><?=$activity_title?> - <?=$site_title?></title>
            <?php
                include("../../_system/styles.php");
            ?>
        </head>
        <body class="grey lighten-4">
            <nav class="<?=$primary_color?>">
            <a class="title"><?=$activity_title?></a>
            <a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
            </nav>
            <div class="container">
                <br><br>
                
                <div class="input-field">
                    <input type="text" id="subject_title" value="<?=$subject_title?>">
                    <label for="subject_title">Title</label>
                </div>
                
                <div class="input-field">
                    <textarea id="subject_description" class="materialize-textarea"><?=$subject_description?></textarea>
                    <label for="subject_description">Description</label>
                </div>
                            
                <div class="row">
                
                <div class="input-field col s6">
                    <select id="grade" class="browser-default">
                        <option disabled>Grade</option>
                    <?php
                    foreach($grade_list as $grade_entry){
                        $selected = "";
                        if($grade_entry === $grade) $selected = "selected";
                        echo "<option value='$grade_entry' $selected>$grade_entry</option>";
                    }
                    ?>
                    </select>
                </div>
                                        
                <div class="input-field col s6">
                    <input type="text" id="subject_code" value="<?=$subject_code?>">
                    <label for="subject_code">Subject Code</label>
                </div>
                
                </div>
                                        
                <div class="row">
                
                <div class="input-field col s6">
                    <input type="text" id="units" value="<?=$units?>">
                    <label for="units">Units</label>
                </div>
                
                </div>
                
                <br><br>
                <button id="createSubjectButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>"><?=$button?></button>
            <span id="response" class="red-text"></span>
                
                <br><br><br><br><br>
            </div>
        </body>
    </html>
    <script type="text/javascript">
        $("#createSubjectButton").click(function(){
            createSubject();
        });
        
        function createSubject(){
            
            var t = $("#subject_title").val();
            var d = $("#subject_description").val();
            var g = $("#grade").val();
            var c = $("#subject_code").val();
            var u = $("#units").val();
            if(!t){
                $("#response").html("Title cannot be empty");
            } else {
                if(!g){
                    $("#response").html("Grade/Class Type is Required");
                } else {
                                    
                    $.ajax({
                        type: 'POST',
                        url: '<?=$url?>',
                        data: {
                            <?php
                            if(empty($subject_id)){
                            } else {
                            echo "subject_id: '$subject_id',";
                            }
                            ?>
                            subject_title: t,
                            subject_description: d,
                            grade: g,
                            subject_code: c,
                            units: u
                        },
                        cache: false,
                        success: function(result){
                            $("#response").html(result);
                            <?php
                            if(empty($class_id)){
                                echo "
                                $(\"input[type=text], textarea\").val(\"\");
                                ";
                            }
                            ?>
                        }
                    }).fail(function(){
                        $("#response").html("Error connecting to server");
                    });
                    
                }
            }
        }
    </script>
    <!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->