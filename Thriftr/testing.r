rm(list=ls())
library('e1071')
args <- commandArgs(TRUE)
year <- args[1]
month <- args[2]
day <- args[3]
weekday <- args[4]
hour <- args[5]
area_id <- args[6]
max <- args[7]
humidity <-args[8]
heat_index <-args[9]
Speed <- args[10]
Rainfall_amount <- args[11]
is_T <- args[12]
is_L <- args[13]
is_bus <- args[14]
is_ped <- args[15]
is_uturn <- args[16]
is_inter <- args[17]
is_mrt_stop <- args[18]
is_sale <- args[19]
is_accident <- args[20]
is_event <- args[21]
direction <- args[22]

load("HLmodel2.rda")

df = data.frame("year"=year,"month"=month, "day"=day,"weekday"=weekday,"hour"=hour,"area_id"=area_id, "Maximum"=max, "Humidity"=humidity, "heat_index"=heat_index,"Speed"=Speed,"Rainfall_amount"=Rainfall_amount,"is_Thunderstorm"=is_T, "is_Lightnight"=is_L,"is_bus_stop"=is_bus, "is_pedestrian_lane"=is_ped,"is_uturn_slot"=is_uturn,"is_intersection"=is_inter, "is_mrt_stop"=is_mrt_stop,"is_sale"=is_sale,"is_accident"=is_accident,"is_event"=is_event,"direction"=direction,level="H")

predict(HLmodel, df[sample(1:1,1),], type="raw")




