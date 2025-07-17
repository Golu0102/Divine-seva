<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pooja Booking Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
            color: #212529;
            margin: 0;
            padding: 0;
        }

        .container {
            background: #ffffff;
            border-radius: 8px;
            padding: 25px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #6c63ff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.6;
            font-size: 16px;
            margin: 10px 0;
        }

        ul {
            padding-left: 20px;
            margin: 15px 0;
        }

        li {
            font-size: 15px;
            margin-bottom: 6px;
        }

        .highlight {
            font-weight: bold;
            color: #343a40;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #6c757d;
            text-align: center;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 20px 15px;
                margin: 10px;
            }

            h2 {
                font-size: 20px;
            }

            p,
            li {
                font-size: 15px;
            }

            ul {
                padding-left: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>🙏 Namaste {{ $booking->name }},</h2>

        @if ($booking->status == 'Pending')
            <p>हमने आपकी पूजा की बुकिंग रिक्वेस्ट सफलतापूर्वक प्राप्त कर ली है।</p>
            <p>आपकी रिक्वेस्ट <span class="highlight">Pending</span> स्थिति में है। हमारी टीम जल्दी ही आपकी डिटेल्स को
                वेरीफाई करके आपसे संपर्क करेगी।</p>
            <p>धन्यवाद कि आपने हमें चुना।</p>
        @elseif($booking->status == 'Confirmed')
            <p>बधाई हो! आपकी पूजा की बुकिंग को <span class="highlight">Confirm</span> कर दिया गया है।</p>
            <p>हमारी टीम निर्धारित समय से पहले आपसे संपर्क करेगी और पूरी प्रक्रिया सुनिश्चित करेगी।</p>
            <p>आपकी भक्ति में हमें शामिल होने का अवसर देने के लिए धन्यवाद।</p>
        @elseif($booking->status == 'Cancel')
            <p>हमें खेद है कि आपकी बुकिंग को <span class="highlight">Cancel</span> कर दिया गया है।</p>
            <p>यदि आपको और जानकारी चाहिए या फिर से बुक करना चाहें, तो कृपया हमसे संपर्क करें।</p>
            <p>हम आपकी सेवा में सदैव तत्पर हैं।</p>
        @elseif($booking->status == 'Completed')
            <p>आपकी पूजा <span class="highlight">सफलतापूर्वक पूर्ण</span> हो चुकी है।</p>
            <p>आपके विश्वास और भक्ति के लिए हम हृदय से आभार व्यक्त करते हैं।</p>
            <p>ईश्वर आपकी हर मनोकामना पूर्ण करें।</p>
            <p>हमें खुशी होगी अगर आप हमारे सेवा अनुभव पर अपना फीडबैक दें।</p>
            <p>
                👉 <a href="{{ url('/feedback/' . $booking->id) }}" style="color: #6c63ff; font-weight: bold;">Click here
                    to share your feedback</a>
            </p>
        @endif

        <hr style="margin: 20px 0;">

        <p><strong>🔖 Booking Details:</strong></p>
        <ul>
            <li><strong>Pooja:</strong> {{ $booking->pooja->name ?? '—' }}</li>
            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</li>
            <li><strong>Time:</strong> {{ $booking->time }}</li>
            <li><strong>Status:</strong> {{ ucfirst($booking->status) }}</li>
        </ul>

        <div class="footer">
            <p>जय श्री राम 🚩 | Team {{ $setting->site_name ?? 'Divine Seva' }}</p>

            <p style="margin-top: 8px;">
                📧 <strong>Email:</strong> {{ $setting->email ?? 'seva@divine.com' }}<br>
                📞 <strong>Call:</strong> {{ $setting->mobile ?? '+91 12345 67890' }}
            </p>

            <p style="margin-top: 15px; font-style: italic;">This is an automated message. Please do not reply directly.
            </p>
        </div>
    </div>
</body>

</html>
