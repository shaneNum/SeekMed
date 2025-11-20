<?php
class DashboardController extends Controller
{
public function index()
{
// initial counts & latest items
$doctorsCount = Doctor::count();
$articles = Article::latest()->limit(6)->get();


return view('dashboard.index', compact('doctorsCount', 'articles'));
}


// AJAX search doctors
public function searchDoctors(Request $request)
{
$q = $request->get('q', '');
$doctors = Doctor::where('name', 'like', "%{$q}%")
->orWhere('specialty', 'like', "%{$q}%")
->limit(20)
->get();


return response()->json(['data' => $doctors]);
}


// consultations for logged in userDashboardController.php
public function consultations(Request $request)
{
$user = Auth::user();
$perPage = intval($request->get('per_page', 10));


$items = Consultation::where('user_id', $user->id)
->latest()
->paginate($perPage);


return response()->json($items);
}


// public or user-targeted articles
public function articles(Request $request)
{
$perPage = intval($request->get('per_page', 6));
$items = Article::latest()->paginate($perPage);
return response()->json($items);
}
}