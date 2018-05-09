package com.maxpilotto.trucktr4ck3r.objects;

import java.sql.Date;
import java.sql.Time;
import java.util.ArrayList;
import java.util.List;

/**
 * Project: truck-app
 * Created by: Max
 * Date: 09/05/2018 @ 15:04
 * Package: com.maxpilotto.trucktr4ck3r.objects
 */
public class PositionUpdate {
    private Date date;
    private Time time;
    private float latitude;
    private float longitude;
    private int speed;
    private int shipment;

    public PositionUpdate(Date date, Time time, float latitude, float longitude, int speed, int shipment) {
        this.date = date;
        this.time = time;
        this.latitude = latitude;
        this.longitude = longitude;
        this.speed = speed;
        this.shipment = shipment;
    }

    public static List<String> toStringList(List<PositionUpdate> updates){
        List<String> list = new ArrayList<>();

        for (PositionUpdate pos : updates) {
            list.add(String.format("%s,%s Lon:%s Lat:%s Km/h:%s",pos.getDate(),pos.getTime(),pos.getLongitude(),pos.getLatitude(),pos.getSpeed()));
        }

        return list;
    }

    @Override
    public String toString() {
        return String.format("%s,%s Lon:%s Lat:%s Km/h:%s",this.getDate(),this.getTime(),this.getLongitude(),this.getLatitude(),this.getSpeed());
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public Time getTime() {
        return time;
    }

    public void setTime(Time time) {
        this.time = time;
    }

    public float getLatitude() {
        return latitude;
    }

    public void setLatitude(float latitude) {
        this.latitude = latitude;
    }

    public float getLongitude() {
        return longitude;
    }

    public void setLongitude(float longitude) {
        this.longitude = longitude;
    }

    public int getSpeed() {
        return speed;
    }

    public void setSpeed(int speed) {
        this.speed = speed;
    }

    public int getShipment() {
        return shipment;
    }

    public void setShipment(int shipment) {
        this.shipment = shipment;
    }
}
