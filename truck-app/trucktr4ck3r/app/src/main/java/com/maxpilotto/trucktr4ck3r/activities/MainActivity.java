package com.maxpilotto.trucktr4ck3r.activities;

import android.Manifest;
import android.annotation.SuppressLint;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Build;
import android.preference.PreferenceManager;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.MotionEvent;
import android.view.View;
import android.view.WindowManager;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.maxpilotto.trucktr4ck3r.R;
import com.maxpilotto.trucktr4ck3r.objects.PositionUpdate;
import com.maxpilotto.trucktr4ck3r.tasks.RequestDriverInfo;
import com.maxpilotto.trucktr4ck3r.tasks.SendPositionUpdate;
import com.maxpilotto.trucktr4ck3r.utils.HttpResponse;

import org.json.JSONException;

import java.sql.Date;
import java.sql.Time;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;


public class MainActivity extends AppCompatActivity {
    private final static int REQUEST_LOGIN_CODE = 10;

    private SharedPreferences preferences;
    private List<PositionUpdate> updates;
    private List<String> updatesStrings;
    private ArrayAdapter adapter;
    private int shipmentId;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        setFullScreen();

        preferences = PreferenceManager.getDefaultSharedPreferences(this);
        if (!preferences.getBoolean("logged",false)){
            startActivityForResult(new Intent(this,LoginActivity.class),REQUEST_LOGIN_CODE);
        }else{
            RequestDriverInfo request = new RequestDriverInfo(preferences.getString("username",""),preferences.getString("password",""), new RequestDriverInfo.RequestListener() {
                @Override
                public void onReceive(HttpResponse response) {
                    if (response.getCode() == HttpResponse.CODE_OK){
                        try {
                            shipmentId = response.getObject().getInt("shipmentId");
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        try {
                            ((TextView)findViewById(R.id.driver)).setText(String.format("User: %s, Driver: %s %s",preferences.getString("username",""),response.getObject().getString("name"),response.getObject().getString("surname")));
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }
            });
            request.execute();
        }

        updatesStrings = new ArrayList<>();
        updates = new ArrayList<>();
        adapter = new ArrayAdapter(this,android.R.layout.simple_list_item_1,updatesStrings);
        ((ListView)findViewById(R.id.positionList)).setAdapter(adapter);

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            Toast.makeText(this,"Location not available, please enable location in app's permissions",Toast.LENGTH_LONG).show();
        }else{
            LocationManager locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);
            locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 5000, 10, new LocationListener() {
                @Override
                public void onLocationChanged(Location location) {
                    Log.d("test","position changed");

                    final PositionUpdate update = new PositionUpdate(
                            new Date(System.currentTimeMillis()),
                            new Time(System.currentTimeMillis()),
                            (float)location.getLatitude(),
                            (float)location.getLongitude(),
                            new Random().nextInt(60) + 60,
                            shipmentId
                    );

                    if(preferences.getBoolean("logged",false)){
                        SendPositionUpdate sendTask = new SendPositionUpdate(
                                preferences.getString("username",""),
                                preferences.getString("password",""),
                                update,
                                new SendPositionUpdate.RequestListener() {
                                    @Override
                                    public void onReceive(HttpResponse response) {
                                        if (response.getCode() == HttpResponse.CODE_OK) {
                                            updatesStrings.add(update.toString());
                                            updates.add(update);
                                            adapter.notifyDataSetChanged();
                                        }
                                    }
                                }
                        );
                        sendTask.execute();
                    }
                }

                @Override
                public void onStatusChanged(String s, int i, Bundle bundle) {

                }

                @Override
                public void onProviderEnabled(String s) {

                }

                @Override
                public void onProviderDisabled(String s) {

                }
            });
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == REQUEST_LOGIN_CODE){
            if (resultCode == LoginActivity.RESULT_OK){
                preferences.edit().putBoolean("logged",true).apply();
                preferences.edit().putString("username",data.getStringExtra("username")).apply();
                preferences.edit().putString("password",data.getStringExtra("password")).apply();
                shipmentId = data.getIntExtra("shipmentId",0);
                ((TextView)findViewById(R.id.driver)).setText(String.format("User: %s, Driver: %s %s",data.getStringExtra("username"),data.getStringExtra("name"),data.getStringExtra("surname")));
            }else{
                Toast.makeText(this, "Wrong username or password", Toast.LENGTH_SHORT).show();
                startActivityForResult(new Intent(this,LoginActivity.class),REQUEST_LOGIN_CODE);
            }
        }
    }

    private void setFullScreen(){
        if (Build.VERSION.SDK_INT < 16) {
            getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        }
    }
}
