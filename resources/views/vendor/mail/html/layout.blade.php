<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    
    <!--[if !mso]><!-->
   <style type="text/css">
	
		@font-face {
		  font-family: 'HelveticaNeue', Arial,Helvetica,sans-serif;
		  src: url("https://dev.letsdrool.ch/assets/fonts/HelveticaNeue.eot");
		  src: url("https://dev.letsdrool.ch/assets/fonts/HelveticaNeue.eot") format("embedded-opentype"), url("https://dev.letsdrool.ch/assets/fonts/HelveticaNeue.woff2") format("woff2"), url("https://dev.letsdrool.ch/assets/fonts/HelveticaNeue.woff") format("woff"), url("https://dev.letsdrool.ch/assets/fonts/HelveticaNeue.ttf") format("truetype"), url("https://dev.letsdrool.ch/assets/fonts/HelveticaNeue.svg#HelveticaNeue") format("svg"); }

		@font-face {
		  font-family: 'HelveticaNeueLTStd-Lt', Arial,Helvetica,sans-serif;
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_0_0.eot");
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_0_0.eot?#iefix") format("embedded-opentype"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_0_0.woff2") format("woff2"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_0_0.woff") format("woff"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_0_0.ttf") format("truetype"); }

		@font-face {
		  font-family: 'HelveticaNeueLTStd-Bd', Arial,Helvetica,sans-serif;
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_1_0.eot");
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_1_0.eot?#iefix") format("embedded-opentype"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_1_0.woff2") format("woff2"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_1_0.woff") format("woff"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_1_0.ttf") format("truetype"); }

		@font-face {
		  font-family: 'HelveticaNeueLTStd-Roman', Arial,Helvetica,sans-serif;
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_2_0.eot");
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_2_0.eot?#iefix") format("embedded-opentype"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_2_0.woff2") format("woff2"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_2_0.woff") format("woff"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_2_0.ttf") format("truetype"); }

		@font-face {
		  font-family: 'HelveticaNeueLTStd-Th', Arial,Helvetica,sans-serif;
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_3_0.eot");
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_3_0.eot?#iefix") format("embedded-opentype"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_3_0.woff2") format("woff2"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_3_0.woff") format("woff"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_3_0.ttf") format("truetype"); }

		@font-face {
		  font-family: 'HelveticaNeueLTStd-Md', Arial,Helvetica,sans-serif;
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_4_0.eot");
		  src: url("https://dev.letsdrool.ch/assets/fonts/333FA9_4_0.eot?#iefix") format("embedded-opentype"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_4_0.woff2") format("woff2"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_4_0.woff") format("woff"), url("https://dev.letsdrool.ch/assets/fonts/333FA9_4_0.ttf") format("truetype"); }

		@font-face {
		  font-family: "Flaticon";
		  src: url("https://dev.letsdrool.ch/assets/fonts/Flaticon.eot");
		  src: url("https://dev.letsdrool.ch/assets/fonts/Flaticon.eot?#iefix") format("embedded-opentype"),
			   url("https://dev.letsdrool.ch/assets/fonts/Flaticon.woff") format("woff"),
			   url("https://dev.letsdrool.ch/assets/fonts/Flaticon.ttf") format("truetype"),
			   url("https://dev.letsdrool.ch/assets/fonts/Flaticon.svg#Flaticon") format("svg");
		  font-weight: normal;
		  font-style: normal;
		}
	</style>
   <!--<![endif]-->
   
    <style>

		@media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>

</head>
<body>
   
    <table class="email-wrap" width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    {{ $header or '' }}

                    <!-- Email Body -->
                   <tr>
						<td>
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                                        {{ $subcopy or '' }}
                                    </td>
                                </tr>
					{{ $footer or '' }}
                </table>
				
				  
            </td>
        </tr>
    </table>
</body>
</html>
