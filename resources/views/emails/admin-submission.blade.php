@php
    $settings = \App\Settings\SettingSingleton::getInstance();
    $isRtl = app()->getLocale() === 'ar';
    $dir = $isRtl ? 'rtl' : 'ltr';
    $start = $isRtl ? 'right' : 'left';
    $end = $isRtl ? 'left' : 'right';
    $siteName = $settings->getItem('site_name') ?: config('app.name');
    $font = $isRtl ? "Tahoma, 'Segoe UI', Arial, sans-serif" : "'Segoe UI', Helvetica, Arial, sans-serif";

    // light tint of the accent colour for the badge (plain hex: Outlook ignores rgba backgrounds)
    [$r, $g, $b] = sscanf($accent, '#%02x%02x%02x');
    $accentSoft = sprintf('#%02x%02x%02x', 255 - (255 - $r) * 0.12, 255 - (255 - $g) * 0.12, 255 - (255 - $b) * 0.12);

    // logo embedded in the email (shows even when the mail app blocks remote images); getItem picks the logo of the current language
    $logoPath = $settings->getItem('logo_en');
    $logoFile = $logoPath ? public_path($logoPath) : null;
    $logoSrc = null;
    if ($logoFile && is_file($logoFile)) {
        $logoSrc = isset($message) ? $message->embed($logoFile) : asset($logoPath);
    }
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $dir }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ __('emails.' . $type . '.title') }}</title>
    <style>
        @media only screen and (max-width: 620px) {
            .card { border-radius: 0 !important; }
            .pad { padding-left: 20px !important; padding-right: 20px !important; }
            .row-label, .row-value { display: block !important; width: 100% !important; }
            .row-label { padding-bottom: 2px !important; border-bottom: 0 !important; }
            .row-value { padding-top: 0 !important; }
            .title { font-size: 21px !important; }
            .btn a { display: block !important; }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#f1eff7; -webkit-text-size-adjust:100%;">
    <div style="display:none; max-height:0; overflow:hidden; opacity:0;">
        {{ __('emails.' . $type . '.title') }} — {{ $senderName }}
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f1eff7"
        style="background-color:#f1eff7;">
        <tr>
            <td align="center" style="padding:28px 12px;">

                <table role="presentation" class="card" width="600" cellpadding="0" cellspacing="0" border="0"
                    dir="{{ $dir }}"
                    style="width:100%; max-width:600px; background-color:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 12px 32px rgba(20,8,60,0.10); font-family:{{ $font }};">

                    {{-- header --}}
                    <tr>
                        <td align="center" bgcolor="#100028"
                            style="background-color:#100028; background-image:linear-gradient(135deg,#100028 0%,#1a1c6e 60%,#2e38a3 100%); padding:30px 24px;">
                            @if ($logoSrc)
                                <img src="{{ $logoSrc }}" alt="{{ $siteName }}" height="46"
                                    style="display:block; height:46px; width:auto; max-width:220px; border:0;">
                            @else
                                <span style="color:#ffffff; font-size:24px; font-weight:700; letter-spacing:1px;">{{ $siteName }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td height="4" bgcolor="{{ $accent }}" style="height:4px; line-height:4px; font-size:0; background-color:{{ $accent }};">&nbsp;</td>
                    </tr>

                    {{-- title --}}
                    <tr>
                        <td class="pad" style="padding:30px 36px 6px; text-align:{{ $start }};">
                            <span style="display:inline-block; padding:5px 14px; border-radius:999px; background-color:{{ $accentSoft }}; color:{{ $accent }}; font-size:13px; font-weight:700;">
                                {{ __('emails.' . $type . '.badge') }}
                            </span>
                            <h1 class="title" style="margin:16px 0 8px; color:#150a33; font-size:24px; line-height:1.35; font-weight:700;">
                                {{ __('emails.' . $type . '.title') }}
                            </h1>
                            <p style="margin:0; color:#5d5873; font-size:15px; line-height:1.7;">
                                {{ __('emails.' . $type . '.intro') }}
                            </p>
                        </td>
                    </tr>

                    {{-- details --}}
                    <tr>
                        <td class="pad" style="padding:20px 36px 4px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="border:1px solid #ece8f4; border-radius:14px; border-collapse:separate; overflow:hidden;">
                                @foreach ($details as $row)
                                    @php $last = $loop->last ? '0' : '1px solid #ece8f4'; @endphp
                                    <tr>
                                        <td class="row-label" width="36%" valign="top"
                                            style="padding:13px 16px; background-color:#faf9fd; color:#8a849e; font-size:13px; line-height:1.5; text-align:{{ $start }}; border-bottom:{{ $last }};">
                                            {{ $row['label'] }}
                                        </td>
                                        <td class="row-value" valign="top"
                                            style="padding:13px 16px; background-color:#faf9fd; color:#1d1636; font-size:15px; font-weight:600; line-height:1.5; text-align:{{ $start }}; border-bottom:{{ $last }}; word-break:break-word;">
                                            @if (!empty($row['href']))
                                                <a href="{{ $row['href'] }}" dir="ltr"
                                                    style="color:{{ $accent }}; text-decoration:none; unicode-bidi:embed;">{{ $row['value'] }}</a>
                                            @else
                                                {{ $row['value'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    {{-- visitor message --}}
                    @if (filled($messageText))
                        <tr>
                            <td class="pad" style="padding:18px 36px 0; text-align:{{ $start }};">
                                <p style="margin:0 0 8px; color:#8a849e; font-size:13px;">{{ __('emails.fields.message') }}</p>
                                <div style="padding:14px 16px; background-color:#f7f5fc; border-{{ $start }}:4px solid {{ $accent }}; border-radius:10px; color:#2a2344; font-size:15px; line-height:1.75; white-space:pre-line; word-break:break-word;">{{ trim($messageText) }}</div>
                            </td>
                        </tr>
                    @endif

                    {{-- attachment note --}}
                    @if ($hasAttachment)
                        <tr>
                            <td class="pad" style="padding:16px 36px 0; text-align:{{ $start }};">
                                <p style="margin:0; padding:11px 14px; background-color:#f4fbf7; border:1px dashed #b7e4c7; border-radius:10px; color:#2f6b45; font-size:14px; line-height:1.6;">
                                    &#128206;&nbsp; {{ __('emails.attachment_' . $type) }}
                                </p>
                            </td>
                        </tr>
                    @endif

                    {{-- button --}}
                    <tr>
                        <td class="pad" align="center" style="padding:28px 36px 8px;">
                            <table role="presentation" class="btn" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" bgcolor="{{ $accent }}" style="border-radius:12px; background-color:{{ $accent }};">
                                        <a href="{{ $dashboardUrl }}" target="_blank"
                                            style="display:inline-block; padding:14px 34px; color:#ffffff; font-size:15px; font-weight:700; text-decoration:none; border-radius:12px;">
                                            {{ __('emails.view_in_dashboard') }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            @if ($canReply)
                                <p style="margin:14px 0 0; color:#8a849e; font-size:13px; line-height:1.6;">
                                    {{ __('emails.reply_hint', ['name' => $senderName]) }}
                                </p>
                            @endif
                        </td>
                    </tr>

                    {{-- footer --}}
                    <tr>
                        <td class="pad" style="padding:24px 36px 26px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="border-top:1px solid #ece8f4;">
                                <tr>
                                    <td style="padding-top:16px; color:#a19bb3; font-size:12px; line-height:1.6; text-align:center;">
                                        {{ __('emails.submitted_at', ['date' => $submittedAt]) }}<br>
                                        {{ __('emails.footer', ['site' => $siteName]) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>
