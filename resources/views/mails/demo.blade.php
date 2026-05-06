<!DOCTYPE html>
<html>
<head>
    <title>Welcome to GymHub!</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0a0a0a; padding: 20px; color: #f5f5f5;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #141414; padding: 40px; border-radius: 16px; border: 1px solid #262626; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3);">
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="display: inline-block; padding: 10px 20px; background: linear-gradient(135deg, #39FF14 0%, #2ee60f 100%); border-radius: 8px; font-weight: bold; font-size: 24px; color: black;">
                🏋️ GymHub
            </div>
        </div>

        <h1 style="color: #f5f5f5; font-size: 22px; text-align: center; margin-bottom: 20px;">{{ $mailData['title'] }}</h1>
        <p style="color: #a3a3a3; line-height: 1.8; font-size: 16px; text-align: center;">{{ $mailData['body'] }}</p>
        
        <div style="background: #0d0d0d; border: 1px solid #262626; border-radius: 8px; padding: 20px; margin: 24px 0;">
            <p style="color: #737373; font-size: 13px; font-weight: 600; margin: 0 0 12px 0;">📋 GymHub ережелері:</p>
            <ul style="color: #a3a3a3; font-size: 13px; line-height: 2; padding-left: 20px; margin: 0;">
                <li>Жаттығу алдында 10-15 минут разминка жасаңыз</li>
                <li>Жаттығу кезінде кемінде 2 литр су ішіңіз</li>
                <li>Құрылғыларды пайдаланғаннан кейін тазалаңыз</li>
                <li>Аптасына 1-2 демалыс күн алыңыз</li>
                <li>Ауыр салмақ көтерген кезде серіктес қолданыңыз</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="#" style="display: inline-block; padding: 14px 30px; background-color: #39FF14; color: black; text-decoration: none; border-radius: 30px; font-weight: 600;">Жаттығуды бастау</a>
        </div>
        
        <hr style="border: 0; border-top: 1px solid #262626; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #525252; text-align: center;">Бұл хат GymHub платформасынан автоматты түрде жіберілді. <br> &copy; 2026 GymHub</p>
    </div>
</body>
</html>
