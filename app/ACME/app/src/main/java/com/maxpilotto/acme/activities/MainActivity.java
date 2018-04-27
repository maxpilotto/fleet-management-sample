package com.maxpilotto.acme.activities;

import android.Manifest;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.preference.PreferenceManager;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.Toast;

import com.maxpilotto.acme.R;
import com.maxpilotto.acme.tasks.RequestDriverInfo;
import com.maxpilotto.acme.utils.ACMEHttpResponseListener;
import com.maxpilotto.acme.utils.HttpResponse;
import com.maxpilotto.acme.utils.HttpResponseParser;

import org.json.JSONException;

public class MainActivity extends AppCompatActivity {

    private SharedPreferences preferences;
    private LocationManager locationManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        preferences = PreferenceManager.getDefaultSharedPreferences(this);
        locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);

        if (preferences.getString("username", null) == null) {
            //TODO Ask user to login
        } else {
            //TODO Allow user to logout
        }
/*
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            Toast.makeText(this,"Location not available, please enable location in app's permissions",Toast.LENGTH_LONG).show();
        }else{
            locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 5000, 10, new LocationListener() {
                @Override
                public void onLocationChanged(Location location) {

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
        }*/

        RequestDriverInfo request = new RequestDriverInfo("driv1", "pass", new ACMEHttpResponseListener() {
            @Override
            public void onResponseReceived(String response) {
                try {
                    HttpResponse r = HttpResponseParser.parse(response,"shipmentId");
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        });
        request.execute();

    }
}
