<?php

$suggestion = "";
$imageUrl = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $experience = isset($_POST['experience']) ? $_POST['experience'] : [];
    $background = $_POST['background'] ?? '';
    $employed = $_POST['employed'] ?? '';
    $career_track = $_POST['career_track'] ?? '';


    if (empty($experience) || empty($background) || empty($employed) || empty($career_track)) {
        $suggestion = "Please answer all questions.";
        $imageUrl = "";
    } else {
       
        $experience_value = implode(', ', $experience); 
        switch ($career_track) {
            case 'Software Development':
                if ($experience_value == "0-2" || $employed == "no") {
                    $suggestion = "Consider applying for junior developer roles or internships.";
                    $imageUrl = "SoftwareDevelopment.jpg";
                } elseif ($experience_value == "2-5") {
                    $suggestion = "You might be suited for mid-level developer roles.";
                    $imageUrl = "SoftwareDevelopment.jpg";
                } else {
                    $suggestion = "Look for senior developer positions or team lead roles.";
                    $imageUrl = "SoftwareDevelopment.jpg";
                }
                break;
            case 'Data Science':
                if ($experience_value == "0-2" || $employed == "no") {
                    $suggestion = "Consider applying for entry-level data analyst positions.";
                    $imageUrl = "dataScience.png";
                } elseif ($experience_value == "2-5") {
                    $suggestion = "You might be suited for data scientist or data engineer roles.";
                    $imageUrl = "dataScience.png";
                } else {
                    $suggestion = "Look for senior data scientist positions or managerial roles.";
                    $imageUrl = "dataScience.png";
                }
                break;
            case 'Cloud Computing':
                if ($experience_value == "0-2" || $employed == "no") {
                    $suggestion = "Consider applying for entry-level cloud engineer positions.";
                    $imageUrl = "cloud.png";
                } elseif ($experience_value == "2-5") {
                    $suggestion = "You might be suited for cloud software engineer roles.";
                    $imageUrl = "cloud.png";
                } else {
                    $suggestion = "Look for senior cloud software engineer managerial roles.";
                    $imageUrl = "cloud.png";
                }
                break;
            case 'Devops':
                if ($experience_value == "0-2" || $employed == "no") {
                    $suggestion = "Consider applying for entry-level Devops engineer positions.";
                    $imageUrl = "devops.webp";
                } elseif ($experience_value == "2-5") {
                    $suggestion = "You might be suited for Devops engineer roles.";
                    $imageUrl = "devops.webp";
                } else {
                    $suggestion = "Look for senior Devops managerial roles.";
                    $imageUrl = "devops.webp";
                }
                break;
            default:
                $suggestion = "Please specify a valid career track.";
                $imageUrl = "correct.jpg";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Career Suggestion Form</title>
    <style>
        body {
            background-color: #FFDFD6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .question {
            display: none;
        }

        .question.active {
            display: block;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="checkbox"], input[type="radio"] {
            margin-right: 8px;
        }

        input[type="text"] {
            width: 280px;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #FF6F61;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #FF3E30;
        }

        .suggestion {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            position: absolute;
            padding: 20px;
            margin-top: 20px;
           
            
        }

        .suggestion h1 {
            font-size: 24px;
            color: #FF6F61;
        }

        .suggestion p {
            font-size: 18px;
            color: #555;
        }

        .suggestion img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container" id="formContainer">
        <h1>Career Suggestion Form</h1>
        <form action="main.php" method="POST" id="careerForm">
            <div class="question active" id="question1">
                <label for="experience">How many years of experience do you have?</label>
                <input type="checkbox" id="experience1" name="experience[]" value="0-2"> 0-2 years<br>
                <input type="checkbox" id="experience2" name="experience[]" value="2-5"> 2-5 years<br>
                <input type="checkbox" id="experience3" name="experience[]" value="5+"> 5+ years<br>
                <button type="button" onclick="showNextQuestion(1)">Next</button>
            </div>
            <div class="question" id="question2">
                <label for="background">What is your professional background?</label>
                <input type="text" id="background" name="background" required>
                <button type="button" onclick="showNextQuestion(2)">Next</button>
            </div>
            <div class="question" id="question3">
                <label for="employed">Are you currently employed?</label><br>
                <input type="radio" id="employedYes" name="employed" value="yes" required> Yes<br>
                <input type="radio" id="employedNo" name="employed" value="no" required> No<br>
                <button type="button" onclick="showNextQuestion(3)">Next</button>
            </div>
            <div class="question" id="question4">
                <label for="career_track">Which career track do you want to choose?</label><br>
                <input type="checkbox" id="career_track1" name="career_track" value="Software Development"> Software Development<br>
                <input type="checkbox" id="career_track2" name="career_track" value="Data Science"> Data Science<br>
                <input type="checkbox" id="career_track3" name="career_track" value="Cloud Computing"> Cloud Computing<br>
                <input type="checkbox" id="career_track4" name="career_track" value="Devops"> Devops<br>
                <button type="submit" onclick="remo">Submit</button>
            </div>
        </form>
    </div>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div class="container suggestion" id="suggestionContainer">
        <h1>Career Suggestion</h1>
        <p><?php echo htmlspecialchars($suggestion); ?></p>
        <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="Career Image">
        <script>
             document.getElementById('question1').classList.remove(' question active');
        </script>
    </div>
    <?php endif; ?>

    <script>
        function showNextQuestion(currentQuestion) {
            document.getElementById('question' + currentQuestion).classList.remove('active');
            document.getElementById('question' + (currentQuestion + 1)).classList.add('active');
        }
    </script>
</body>
</html>
