<table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td class="panel-content" style="background-color:#b91c1c; border-radius:8px; padding:16px;">
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="panel-item" style="color:#ffffff; font-size:14px; line-height:1.5;">
                        {{ Illuminate\Mail\Markdown::parse($slot) }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
