<?php
/**
 * @package     Joomla - > Site and Administrator payment info
 * @subpackage  com_jgive
 * @subpackage 	Trangell_Zarinpal
 * @copyright   trangell team => https://trangell.com
 * @copyright   Copyright (C) 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined( '_JEXEC' ) or die( ';)' );
	jimport('joomla.html.html');
	jimport( 'joomla.plugin.helper' );
class plgPaymentTrangellZarinpalHelper
{ 		
	function Storelog($name,$logdata)
	{
		jimport('joomla.error.log');
		$options = "{DATE}\t{TIME}\t{USER}\t{DESC}";

		$my = JFactory::getUser();

		JLog::addLogger(
			array(
				'text_file' => $logdata['JT_CLIENT'].'_'.$name.'.log',
				'text_entry_format' => $options
			),
			JLog::INFO,
			$logdata['JT_CLIENT']
		);

		$logEntry = new JLogEntry('Transaction added', JLog::INFO, $logdata['JT_CLIENT']);
		$logEntry->user = $my->name.'('.$my->id.')';
		$logEntry->desc = json_encode($logdata['raw_data']);

		JLog::add($logEntry);
	}

	function saveComment($pg_plugin, $oid, $comment)
		{
			if ($oid)
			{
				$obj   = new stdClass;
				$db    = JFactory::getDBO();
				$query = "SELECT donation_id FROM #__jg_orders WHERE id =" . $oid;
				$db->setQuery($query);

				$obj->id      = $db->loadResult();
				$obj->comment = $comment;

				if ($obj->id)
				{
					if (!$db->updateObject('#__jg_donations', $obj, 'id'))
					{
						echo $db->stderr();
					}
				}
			}
		}
	
    function getGateMsg ($msgId) {
		switch($msgId){
			case	11: $out =  'شماره کارت نامعتبر است';break;
			case	12: $out =  'موجودي کافي نيست';break;
			case	13: $out =  'رمز نادرست است';break;
			case	14: $out =  'تعداد دفعات وارد کردن رمز بيش از حد مجاز است';break;
			case	15: $out =   'کارت نامعتبر است';break;
			case	17: $out =   'کاربر از انجام تراکنش منصرف شده است';break;
			case	18: $out =   'تاريخ انقضاي کارت گذشته است';break;
			case	21: $out =   'پذيرنده نامعتبر است';break;
			case	22: $out =   'ترمينال مجوز ارايه سرويس درخواستي را ندارد';break;
			case	23: $out =   'خطاي امنيتي رخ داده است';break;
			case	24: $out =   'اطلاعات کاربري پذيرنده نامعتبر است';break;
			case	25: $out =   'مبلغ نامعتبر است';break;
			case	31: $out =  'پاسخ نامعتبر است';break;
			case	32: $out =   'فرمت اطلاعات وارد شده صحيح نمي باشد';break;
			case	33: $out =   'حساب نامعتبر است';break;
			case	34: $out =   'خطاي سيستمي';break;
			case	35: $out =   'تاريخ نامعتبر است';break;
			case	41: $out =   'شماره درخواست تکراري است';break;
			case	42: $out =   'تراکنش Sale يافت نشد';break;
			case	43: $out =   'قبلا درخواست Verify داده شده است';break;
			case	44: $out =   'درخواست Verify يافت نشد';break;
			case	45: $out =   'تراکنش Settle شده است';break;
			case	46: $out =   'تراکنش Settle نشده است';break;
			case	47: $out =   'تراکنش Settle يافت نشد';break;
			case	48: $out =   'تراکنش Reverse شده است';break;
			case	49: $out =   'تراکنش Refund يافت نشد';break;
			case	51: $out =   'تراکنش تکراري است';break;
			case	52: $out =   'سرويس درخواستي موجود نمي باشد';break;
			case	54: $out =   'تراکنش مرجع موجود نيست';break;
			case	55: $out =   'تراکنش نامعتبر است';break;
			case	61: $out =   'خطا در واريز';break;
			case	100: $out =   'تراکنش با موفقيت انجام شد.';break;
			case	111: $out =   'صادر کننده کارت نامعتبر است';break;
			case	112: $out =   'خطاي سوئيچ صادر کننده کارت';break;
			case	113: $out =   'پاسخي از صادر کننده کارت دريافت نشد';break;
			case	114: $out =   'دارنده کارت مجاز به انجام اين تراکنش نيست';break;
			case	412: $out =   'شناسه قبض نادرست است';break;
			case	413: $out =   'شناسه پرداخت نادرست است';break;
			case	414: $out =   'سازمان صادر کننده قبض نامعتبر است';break;
			case	415: $out =   'زمان جلسه کاري به پايان رسيده است';break;
			case	416: $out =   'خطا در ثبت اطلاعات';break;
			case	417: $out =   'شناسه پرداخت کننده نامعتبر است';break;
			case	418: $out =   'اشکال در تعريف اطلاعات مشتري';break;
			case	419: $out =   'تعداد دفعات ورود اطلاعات از حد مجاز گذشته است';break;
			case	421: $out =   'IP نامعتبر است';break;
			case	500: $out =   'کاربر به صفحه زرین پال رفته ولي هنوز بر نگشته است';break;
			case	'error': $out ='خطا غیر منتظره رخ داده است';break;
			case	'hck2': $out = 'لطفا از کاراکترهای مجاز استفاده کنید';break;
		}
		return $out;
	}

	 
}
