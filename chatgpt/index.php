<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat with GPT-4</title>
<style>
    #chat-container {
        width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    #messages-container {
        margin-top: 20px;
    }
    .message {
        margin-bottom: 10px;
    }
    .user-message {
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 5px;
    }
    .bot-message {
        background-color: #e0e0e0;
        padding: 10px;
        border-radius: 5px;
    }
</style>
</head>
<body>
<div id="chat-container">
    <form method="post">
        <label for="user-input">Enter your message:</label><br>
        <input type="text" id="user-input" name="user_input"><br>
        <button type="submit">Send</button>
    </form>
    <div id="messages-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_input = $_POST["user_input"];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://chatgpt-42.p.rapidapi.com/conversationgpt4",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => ($user_input . ' write a short novel on this topic.')
                        ]
                    ],
                    'system_prompt' => '',
                    'temperature' => 0.9,
                    'top_k' => 5,
                    'top_p' => 0.9,
                    'max_tokens' => 256,
                    'web_access' => null
                ]),
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: chatgpt-42.p.rapidapi.com",
                    "X-RapidAPI-Key: ce6800172cmshb27a938324518fdp11c4fdjsn085cdd691c7b",
                    "content-type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $bot_response = json_decode($response, true);
                if(isset($bot_response['status']) && $bot_response['status'] == true) {
                    echo '<div class="message bot-message">' . $bot_response['result'] . '</div>';
                } else {
                    echo '<div class="message bot-message">Sorry, I couldn\'t understand your question.</div>';
                }
            }
        }
        ?>
    </div>
</div>
</body>
</html>
