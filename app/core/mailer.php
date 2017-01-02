<?php
namespace Lilly\Core;
require_once CORE_PATH . DS . 'phpmailer' . DS . 'class.smtp.php';
require_once CORE_PATH . DS . 'phpmailer' . DS . 'class.phpmailer.php';

class Mailer
{
    public static function notify($email, $subject, $content) {

        $from = 'no-reply@me.com';
        $mail = new \PHPMailer();
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASS;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = EMAIL_PORT;

        $mail->CharSet = 'UTF-8';
        $mail->From = $from;
        $mail->FromName = APP_HEADER_TITLE;
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body
            = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1" />
                  <title>Narrative Confirm Email</title>
                  <style type="text/css">
                
                  /* Take care of image borders and formatting */
                
                  * {
                    direction: rtl !important;
                    text-align: right !important: 
                  }
                
                  img {
                    max-width: 600px;
                    outline: none;
                    text-decoration: none;
                    -ms-interpolation-mode: bicubic;
                  }
                
                  a {
                    border: 0;
                    outline: none;
                  }
                
                  a img {
                    border: none;
                  }
                
                  /* General styling */
                
                  td, h1, h2, h3  {
                    font-family: Helvetica, Arial, sans-serif;
                    font-weight: 400;
                  }
                
                  td {
                    font-size: 16px;
                    line-height: 150%;
                    text-align: justify;
                  }
                
                  body {
                    -webkit-font-smoothing:antialiased;
                    -webkit-text-size-adjust:none;
                    width: 100%;
                    height: 100%;
                    color: #37302d;
                    background: #ffffff;
                  }
                
                  table {
                    border-collapse: collapse !important;
                  }
                
                
                  h1, h2, h3 {
                    padding: 0;
                    margin: 0;
                    color: #444444;
                    font-weight: 400;
                    line-height: 110%;
                  }
                
                  h1 {
                    font-size: 35px;
                  }
                
                  h2 {
                    font-size: 30px;
                  }
                
                  h3 {
                    font-size: 24px;
                  }
                
                  h4 {
                    font-size: 18px;
                    font-weight: normal;
                  }
                
                  .important-font {
                    color: #21BEB4;
                    font-weight: bold;
                  }
                
                  .hide {
                    display: none !important;
                  }
                
                  .force-full-width {
                    width: 100% !important;
                  }
                
                  </style>
                
                  <style type="text/css" media="screen">
                      @media screen {
                
                        /* Thanks Outlook 2013! */
                        td, h1, h2, h3 {
                          font-family: Arial, sans-serif !important;
                        }
                      }
                  </style>
                
                  <style type="text/css" media="only screen and (max-width: 600px)">
                    /* Mobile styles */
                    @media only screen and (max-width: 600px) {
                
                      table[class="w320"] {
                        width: 320px !important;
                      }
                
                      table[class="w300"] {
                        width: 300px !important;
                      }
                
                      table[class="w290"] {
                        width: 290px !important;
                      }
                
                      td[class="w320"] {
                        width: 320px !important;
                      }
                
                      td[class~="mobile-padding"] {
                        padding-right: 14px !important;
                        padding-right: 14px !important;
                      }
                
                      td[class*="mobile-padding-right"] {
                        padding-right: 14px !important;
                      }
                
                      td[class*="mobile-padding-right"] {
                        padding-right: 14px !important;
                      }
                
                      td[class*="mobile-block"] {
                        display: block !important;
                        width: 100% !important;
                        text-align: left !important;
                        padding-right: 0 !important;
                        padding-right: 0 !important;
                        padding-bottom: 15px !important;
                      }
                
                      td[class*="mobile-no-padding-bottom"] {
                        padding-bottom: 0 !important;
                      }
                
                      td[class~="mobile-center"] {
                        text-align: center !important;
                      }
                
                      table[class*="mobile-center-block"] {
                        float: none !important;
                        margin: 0 auto !important;
                      }
                
                      *[class*="mobile-hide"] {
                        display: none !important;
                        width: 0 !important;
                        height: 0 !important;
                        line-height: 0 !important;
                        font-size: 0 !important;
                      }
                
                      td[class*="mobile-border"] {
                        border: 0 !important;
                      }
                    }
                  </style>
                </head>
                <body class="body" style="direction:rtl !important;padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
                <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
                  <tr>
                    <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
                
                    <table cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                        <td style="background:#b66392" width="100%">
                          <center>
                            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                              <tr>
                                <td valign="top" class="mobile-block mobile-no-padding-bottom mobile-center" width="270" style="direction:rtl !important;background:#b66392;padding:10px 10px 10px 20px;">
                                  <a href="#" style="text-decoration:none;">
                                    <img src="http://www.aqaratc.com/mailasets/logo.png" height="40%" alt="Your Logo"/>
                                  </a>
                                </td>
                                <td valign="top" class="mobile-block mobile-center" width="270" style="direction:rtl !important;background:#b66392;padding:10px 15px 10px 10px">
                                  <table border="0" cellpadding="0" cellspacing="0" class="mobile-center-block" align="left">
                                    <tr>
                                      <td align="right">
                                        <a href="#">
                                        <img src="http://www.aqaratc.com/mailasets/fbicon.png"  width="25" height="25" alt="social icon"/>
                                        </a>
                                      </td>
                                      <td align="right" style="padding-right:5px">
                                        <a href="#">
                                        <img src="http://www.aqaratc.com/mailasets/twicon.png"  width="25" height="25" alt="social icon"/>
                                        </a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </center>
                        </td>
                      </tr>
                      <tr>
                        <td style="direction:rtl !important;border-bottom:1px solid #e7e7e7;">
                          <center>
                            <table cellpadding="0" cellspacing="0" width="600" class="w320">
                              ' . $content . '
                            </table>
                          </center>
                        </td>
                      </tr>
                      <tr>
                        <td style="direction:rtl !important;background-color:#b66392;">
                          <center>
                            <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="direction:rtl !important;height:100%;color:#ffffff" bgcolor="#b66392" >
                              <tr>
                                <td align="left" valign="middle" class="mobile-padding" style="font-size:12px;padding:20px; background-color:#b66392; color:#ffffff; text-align:right; ">
                                  <a style="direction:rtl !important;color: #FFF;font-size:15px;font-weight:bold;text-align:center;display:block;">هذه الرسالة من نظام بواكير - جميع الحقوق محفوظة</a>
                                </td>
                              </tr>
                            </table>
                          </center>
                        </td>
                      </tr>
                    </table>
                
                    </td>
                  </tr>
                </table>
                </body>
                </html>';
        if ($mail->send()) {
            return true;
        }
        return false;
    }
}