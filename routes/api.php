Route::get('favorites', function(Request $request) {
    $ids = explode(',', $request->ids);
    
    $amalans = Amalan::with('kategoris')
        ->whereIn('id', $ids)
        ->get();
    
    return response()->json($amalans);
});