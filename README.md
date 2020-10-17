## Bus Booking Management System

# Based on
- Laravel Framework v8
- php 7.3
- sqlite

# Setup via Docker
- run `./docker-run.sh`
- open `http://localhost:8001`


# APIs

- POST /api/book 
for booking an bus
-- Json Body 
```json
{
    "pickup_station_id": 1,
    "destination_station_id": 3,
    "user_id": 1
}
```
output 
```
{
    "booked": "booked"
}
```


- GET /api/availableSeats/{startStationId}/{endStationId}
output 
```json
{
    "availableSeats": 11
}
```

# Assumptions
I assumed the bus has one trip with different stops, to be fit with business needs instead of making a bus per a trip  

# TODOs
- Searching a bus with criteria (pickup stop and destination)
- unit testing and integration

# Contact
Mohamed Essam Fathalla <mohamedessamfathalla@gmail.com>
