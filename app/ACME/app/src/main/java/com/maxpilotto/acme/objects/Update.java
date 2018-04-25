package com.maxpilotto.acme.objects;

import java.sql.Date;
import java.sql.Time;

/**
 * Project: ACME
 * Created by: Max
 * Date: 24/04/2018 @ 20:47
 * Package: com.maxpilotto.acme.objects
 */
public class Update {
    private Date date;
    private Time time;
    private float latitude;
    private float longitude;
    private int speed;
    private int shipment;

    public Update(Date date, Time time, float latitude, float longitude, int speed, int shipment) {
        this.date = date;
        this.time = time;
        this.latitude = latitude;
        this.longitude = longitude;
        this.speed = speed;
        this.shipment = shipment;
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
