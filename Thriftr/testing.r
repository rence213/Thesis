
library('rpart')
args <- commandArgs(TRUE)
Month <- as.numeric(args[1])
Weekday <- as.numeric(args[2])
Hour <- as.numeric(args[3])
Area_id <- as.numeric(args[4])
max <- as.numeric(args[5])
min<- as.numeric(args[6])
mean <- as.numeric(args[7])
humidity <-as.numeric(args[8])
Heat_index <- as.numeric(args[9])
speed <- as.numeric(args[10])
rainfall_amount <- as.numeric(args[11])
is_T <- as.numeric(args[12])
is_L <- as.numeric(args[13])
is_bus <- as.numeric(args[14])
is_ped <- as.numeric(args[15])
is_uturn <- as.numeric(args[16])
is_inter <- as.numeric(args[17])
is_mrt <- as.numeric(args[18])
Is_event <- as.numeric(args[19])
Direction <- args[20]

load("DecisionTree.rda")

predict(fit, data.frame(month=Month,weekday=Weekday,hour=Hour,area_id=Area_id,Maximum=max,Minimum=min,Mean=mean,Humidity=humidity,heat_index=Heat_index,Speed=speed,Rainfall_amount=rainfall_amount,is_Thunderstorm = is_T,is_Lightining = is_L, is_bus_stop = is_bus,is_pedestrian_lane = is_ped, is_uturn_slot = is_uturn,is_intersection = is_inter, is_mrt_stop=is_mrt, is_event=Is_event, direction=Direction), type="prob")



