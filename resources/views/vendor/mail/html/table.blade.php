<div class="table" style="margin-top: 16px; margin-bottom:16px;">
    <table width="100%" cellpadding="8" cellspacing="0" role="presentation"
        style="border-collapse: collapse; font-size: 14px; width:100%; border:1px solid #e5e7eb;">
        {{ Illuminate\Mail\Markdown::parse($slot) }}
    </table>
</div>
<style>
    .table table th {
        background-color: #b91c1c;
        color: #fff;
        font-weight: bold;
        text-align: left;
    }

    .table table td {
        border: 1px solid #e5e7eb;
        color: #374151;
    }

    .table table tr:nth-child(even) td {
        background-color: #f9fafb;
    }
</style>
