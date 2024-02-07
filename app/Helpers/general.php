<?php

// use Illuminate\Support\Facades\DB;

use App\Models\AssistantDaysOff;
use App\Models\AssistantHours;
use App\Models\AssistantTimes;
use App\Models\CategoryTranslation;
use App\Models\SalonReserve;
use App\Models\Salons;
use App\Models\Cities;
use App\Models\SalonServices;
use App\Models\SalonServicesTranslation;
use App\Models\SentNotification;
use App\Models\Times;
use App\Models\User;
use App\Models\UserCategories;
use Illuminate\Support\Facades\DB;

define('PAGINATION_COUNT', 21);
define('db_limit', 6);
define('location', 50);

function translateIsOwner($is_owner)
{
	switch ($is_owner) {
		case '0':
			if (app()->getLocale() == 'en')
				return "Assistant";
			elseif (app()->getLocale() == 'ar')
				return "موظف";
			break;
		case '1':
			if (app()->getLocale() == 'en')
				return "Owner";
			elseif (app()->getLocale() == 'ar')
				return "مدير";
			break;
		case '2':
			if (app()->getLocale() == 'en')
				return "Customer";
			elseif (app()->getLocale() == 'ar')
				return "عميل";
			break;
	}
}
function favoriteCheck($ad_id,$user_id){
   
    if(!$user_id){
        return 0;
    }
            if(\App\Models\Favorite::where('ad_id',$ad_id)->where('user_id',$user_id)->count() > 0){
                $favorite = 1;
            }else
            $favorite = 0;
    return $favorite;
}
function translateGender($gender)
{
	switch ($gender) {
		case '0':
			if (app()->getLocale() == 'en')
				return "Woman";
			elseif (app()->getLocale() == 'ar')
				return "امرأة";
			break;
		case '1':
			if (app()->getLocale() == 'en')
				return "Male";
			elseif (app()->getLocale() == 'ar')
				return "ذكر";
			break;
	}
}
function translateDayOff($day)
{
	switch ($day->day_off) {
		case '0':
			if (app()->getLocale() == 'en')
				return "Saturday";
			elseif (app()->getLocale() == 'ar')
				return "السبت";
			break;
		case '1':
			if (app()->getLocale() == 'en')
				return "Sunday";
			elseif (app()->getLocale() == 'ar')
				return "الاحد";
			break;
		case '2':
			if (app()->getLocale() == 'en')
				return "Monday";
			elseif (app()->getLocale() == 'ar')
				return "الاثنين";
			break;
		case '3':
			if (app()->getLocale() == 'en')
				return "Tuesday";
			elseif (app()->getLocale() == 'ar')
				return "الثلاثاء";
			break;
		case '4':
			if (app()->getLocale() == 'en')
				return "Wednesday";
			elseif (app()->getLocale() == 'ar')
				return "الاربع";
			break;
		case '5':
			if (app()->getLocale() == 'en')
				return "Thursday";
			elseif (app()->getLocale() == 'ar')
				return "الخميس";
			break;
		case '6':
			if (app()->getLocale() == 'en')
				return "Friday";
			elseif (app()->getLocale() == 'ar')
				return "الجمعه";
			break;
	}
}
function arabicAndenglish(){
	$data['western_arabic'] = array('0','1','2','3','4','5','6','7','8','9');
        $data['eastern_arabic'] = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        $data['arabicLetters'] = [
            'أ', 'ب', 'ت', 'ث', 'ج', 'ح', 'خ', 'د', 'ذ', 'ر', 'ز', 'س', 'ش', 'ص', 'ض', 'ط',
            'ظ', 'ع', 'غ', 'ف', 'ق', 'ك', 'ل', 'م', 'ن', 'ه', 'و', 'ي'
        ];
        $data['englishLetters'] = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q',
            'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
        ];
return $data;
}
function assistantFreeAtDay($assistant_id, $date)
{
	$dayoff = AssistantDaysOff::where('user_id', $assistant_id)->where('day_off', date('w', strtotime($date)))->first();
	if ($dayoff) {
		return false;
	}
	return true;
}
function assistantFreeAt($assistant_id, $time, $duration, $date)
{
	$user = User::with('times')->find($assistant_id);
	// dd(AssistantDaysOff::where('user_id', $user->id)->get());
	$d_off = AssistantDaysOff::where('user_id', $user->id)->get();
	if ($d_off[0]) {
		foreach (AssistantDaysOff::where('user_id', $user->id)->get() as $dayoff) {
			if ($dayoff->day_off == date('w', strtotime($date))) {

				return false;
			}
		}
		// dd(date('w', strtotime($date)), $date);
		if ($time >= ($user->times)[0]->from_time && $time <= ($user->times)[0]->to_time) {
			$strips_checker = $duration / 5;
			$full_time_checker = 0;
			$times_to_flag = [];
			for ($i = 1; $i <= $strips_checker; $i++) {
				$times = Times::where('time', date('G:i', strtotime($time)))->first();
				if ($i != 1) {
					$time_to_add = $i * 5;
					$time_check = date('G:i:s', strtotime('+' . $time_to_add . ' minutes', strtotime($times->time)));
					$times = Times::where('time', date('G:i:s', strtotime($time_check)))->first();
				}
				$time_occupied_check = AssistantHours::where('time_id', $times->id)->where('date', date('Y-m-d', strtotime($date)))->first();
				if ($i == $strips_checker || $i == 1) {
					$time_occupied_check = false;
				}
				if (!$time_occupied_check) {
					$full_time_checker++;
					array_push($times_to_flag, date('G:i:s', strtotime($times->time)));
				}
			}
			if ($full_time_checker == $strips_checker) {
				return $times_to_flag;
			}
		}
	}
	return false;
}
function getIncome($id)
{
	$user = User::where('users.id', $id)
		->join('salon_reserves', 'users.id', '=', 'salon_reserves.user_id')
		->join('salon_services', 'users.salon_id', '=', 'salon_services.salon_id')
		->join('reserve_services', 'salon_services.id', '=', 'reserve_services.service_id')
		->where('salon_reserves.arrive_flag', '2')
		->select(DB::raw('SUM(salon_services.price)/COUNT(DISTINCT(salon_reserves.id)) as total'), DB::raw('COUNT(DISTINCT(salon_reserves.id)) as count'))
		->first();
	return $user;
}
function getCategoryName($id)
{
	$cat = CategoryTranslation::where('category_id', $id)->first();
	return $cat->name;
}
function getAssistantCategories($id)
{
	$categories = [];

	$user_cats = UserCategories::join('category_translations', 'user_categories.category_id', '=', 'category_translations.category_id')->join('categories', 'user_categories.category_id', '=', 'categories.id')->where('category_translations.locale', app()->getLocale())->where('user_id', $id)->select('category_translations.id as cat_id', 'category_translations.name as cat_name', 'categories.icon as icon')->get();
	return $user_cats;
}
function translateService($array)
{

	$services = [];
	if (isset($array[0])) {

		foreach ($array as $key => $service) {
			array_push($services, (SalonServices::where('id', $service->service_id)->first())->name);
		}
	}
	return $services;
}
function translateSingleService($id)
{
	$name = SalonServicesTranslation::where('salon_services_id', $id)->first();
	if (!$name)
		return "External";
	return $name->name;
}
function translateUser($id)
{
	$user = User::find($id);
	return $user->name ;
}
function translateCity($id){
	$city = Cities::find($id);
	return $city->name;
}
function translateSalon($id)
{
	$salon = Salons::where('id', $id)->first();
	return $salon->name;
}
function translatePrevServices($service)
{
	return (SalonServices::where('id', $service)->first())->name;
}
function translateArriveStatus($flag)
{
	switch ($flag) {
		case '0':
			if (app()->getLocale() == 'en')
				return "Didnt arrive";
			elseif (app()->getLocale() == 'ar')
				return "لم يصل بعد";
			break;
		case '1':
			if (app()->getLocale() == 'en')
				return "Customer Arrived";
			elseif (app()->getLocale() == 'ar')
				return "تم وصول الزبون";
			break;
		case '2':
			if (app()->getLocale() == 'en')
				return "Service Completed";
			elseif (app()->getLocale() == 'ar')
				return "تم تقديم الخدمه";
			break;
		case '3':
			if (app()->getLocale() == 'en')
				return "Cancelled";
			elseif (app()->getLocale() == 'ar')
				return "تم الغاء الحجز";
			break;
	}
}
function sortArray($arr = [])
{
	for ($i = 0; $i < count($arr); $i++) {
		$val = $arr[$i];
		$j = $i - 1;
		while ($j >= 0 && $arr[$j] > $val) {
			$arr[$j + 1] = $arr[$j];
			$j--;
		}
		$arr[$j + 1] = $val;
	}
	return $arr;
}




function getClientWallet()
{
	$total_price = 0;
	$user_wallet = auth('api')->user()->wallet_rows;
	if ($user_wallet) {
		foreach ($user_wallet as $key => $item) {
			if ($item->type == 1) {
				$total_price += $item->price;
			} elseif ($item->type == 2) {
				$total_price -= $item->price;
			} else {
				continue;
			}
		}
	}
	return $total_price;
}



function getPaymentTypes()
{
	$methods = [
		'ar' => [
			1 => 'بطاقة الدفع الالكترونيه',
			2 => 'نقدا',
			3 => 'النقاط',
		],
		'en' => [
			1 => 'Payment Card',
			2 => 'Cash',
			3 => 'Points',
		]
	];

	if (app()->getLocale() == 'ar') {
		return $methods['ar'];
	} else {
		return $methods['en'];
	}
}


function getPaymentType($index)
{
	$methods = [
		'ar' => [
			1 => 'بطاقة الدفع الالكترونيه',
			2 => 'نقدا',
			3 => 'النقاط',
		],
		'en' => [
			1 => 'Payment Card',
			2 => 'Cash',
			3 => 'Points',
		]
	];

	if (app()->getLocale() == 'ar') {
		return $methods['ar'][$index];
	} else {
		return $methods['en'][$index];
	}
}


function adminOrderStatus()
{
	$methods = [
		'ar' => [
			0 => 'بانتظار التأكيد',
			1 => 'جاري التجهيز',
			2 => 'تم التجهيز',
			3 => 'في الطريق اليك',
			4 => 'تم التوصيل',
			5 => 'تم الغاء الطلب',
		],
		'en' => [
			0 => 'ًWaiting for Confirming',
			1 => 'Preparation in Progress',
			2 => 'Prepared',
			3 => 'On The Way to You',
			4 => 'Delivered',
			5 => 'Canceled Order',
		]
	];

	if (app()->getLocale() == 'ar') {
		return $methods['ar'];
	} else {
		return $methods['en'];
	}
}


function getOrderStatus($status_value)
{
	$methods = [
		'ar' => [
			0 => 'بانتظار التأكيد',
			1 => 'جاري التجهيز',
			2 => 'تم التجهيز',
			3 => 'في الطريق اليك',
			4 => 'تم التوصيل',
			5 => 'تم الغاء الطلب',
		],
		'en' => [
			0 => 'ًWaiting for Confirming',
			1 => 'Preparation in Progress',
			2 => 'Prepared',
			3 => 'On The Way to You',
			4 => 'Delivered',
			5 => 'Canceled Order',
		]
	];

	if (app()->getLocale() == 'ar') {
		return $methods['ar'][$status_value];
	} else {
		return $methods['en'][$status_value];
	}
}


function getNotificationMessage($message_id)
{
	$messages = [
		'ar' => [
			# Messages From Admin
			0 => 'بانتظار تأكيد طلبك ،رقم : ',
			1 => 'جاري تجهيز طلبك ،رقم : ',
			2 => 'تم تجهيز طلبك ،رقم : ',
			# Messages From Driver
			3 => 'طلبك في الطريق اليك ،رقم : ',
			4 => 'تم توصيل طلبك ،رقم : ',
			# Messages From Admin
			5 => 'تم الغاء طلبك ،رقم : ',
			# Messages From User
			6 => 'طلب جديد ،رقم : ',

		],
		'en' => [
			# Messages From Admin
			0 => 'Waiting for confirmation of your Order ,Number : ',
			1 => 'Your Order is being processed ,Number : ',
			2 => 'Your Order Prepared ,Number : ',
			# Messages From Driver
			3 => 'Your Order on The Way to You ,Number : ',
			4 => 'Your Order has been Delivered ,Number : ',
			# Messages From Admin
			5 => 'Your Order has been Canceled ,Number : ',
			# Messages From User
			6 => 'New order ,Number : ',

		]
	];

	if (app()->getLocale() == 'ar') {
		return $messages['ar'][$message_id];
	} else {
		return $messages['en'][$message_id];
	}
}


// function getWord($id)
// {
// 	$messages = [
// 		'ar' => [
// 			0 => 'طلب جديد',
// 		],
// 		'en' => [
// 			0 => 'New Order',
// 		]
// 	];

// 	if (app()->getLocale() == 'ar') {
// 		return $messages['ar'][$id];
// 	} else {
// 		return $messages['en'][$id];
// 	}
// }


// function getNotifications($receiver_model, $receiver_id = null)
// {
// 	$notys = [];
// 	if ($receiver_id == null) {	# Admin is receiver
// 		$notys = SentNotification::where(['receiver_model' => 'admin'])->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
// 	} else {	# Any Model as receiver except admin
// 		$notys = SentNotification::where(['receiver_model' => $receiver_model, 'receiver_id' => $receiver_id])->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
// 	}
// 	return $notys;
// }


function getFolder()
{

	return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}


function checkExist($item)
{
	if ($item && $item != null) {
		return $item;
	} else {
		return null;
	}
}

function getSale($special_price, $price)
{
	return 100 - (($special_price / $price) * 100);
}

function getReview($model_obj)
{
	$model_stars = $model_obj->reviews->pluck('stars')->toArray();
	// return $model_stars;
	if (count($model_stars) == 0) {
		return 0;
	}
	return ceil(array_sum($model_stars) / count($model_stars));
	// return (1+5) / 2;
}


function uploadImage($photo_name, $folder)
{
	$image = $photo_name;
	$image_name = time() . '' . $image->getClientOriginalName();
	$destinationPath = public_path($folder);
	$image->move($destinationPath, $image_name);
	return $image_name;
}

function deleteFile($photo_name, $folder)
{
	$image_name = $photo_name;
	$image_path = public_path($folder) . $image_name;
	if (file_exists($image_path)) {
		@unlink($image_path);
	}
}

function is_active_req($request)
{
	if (!$request->has('is_active'))
		$request->request->add(['is_active' => 0]);
	else
		$request->request->add(['is_active' => 1]);
}



# Distance between two coordinates in kilos
function distance($lat1, $lon1, $lat2, $lon2)
{
	if (($lat1 == $lat2) && ($lon1 == $lon2)) {
		return 0;
	}
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;

	return number_format(($miles * 1.609344), 0, '.', '');
} // end of distance

function distance2($lat1, $lon1, $lat2, $lon2, $unit)
{
	if (($lat1 == $lat2) && ($lon1 == $lon2)) {
		return 0;
	} else {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
			return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}
} // end of distance2

# Another way to get distance between two coordinates in kilos
function twopoints_on_earth(
	$latitudeFrom,
	$longitudeFrom,
	$latitudeTo,
	$longitudeTo
) {
	$long1 = deg2rad($longitudeFrom);
	$long2 = deg2rad($longitudeTo);
	$lat1 = deg2rad($latitudeFrom);
	$lat2 = deg2rad($latitudeTo);

	//Haversine Formula
	$dlong = $long2 - $long1;
	$dlati = $lat2 - $lat1;

	$val = pow(sin($dlati / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);

	$res = 2 * asin(sqrt($val));

	$radius = 6371;			# For Kilometers
	// $radius = 3958.756;	# For Miles

	return ($res * $radius);
}
