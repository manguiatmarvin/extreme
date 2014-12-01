package com.Xconvert;

import org.apache.log4j.Logger;
import org.quartz.JobDetail;
import org.quartz.Scheduler;
import org.quartz.SchedulerException;
import org.quartz.Trigger;
import org.quartz.impl.StdSchedulerFactory;

import com.Xconvert.jobs.JobDaemon;

import static org.quartz.JobBuilder.*;
import static org.quartz.TriggerBuilder.*;
import static org.quartz.SimpleScheduleBuilder.*;

public class Main {
	static Logger log = Logger.getLogger(Main.class.getName());

	public static void main(String[] args) {
		try {
			// Grab the Scheduler instance from the Factory
			StdSchedulerFactory sf = new StdSchedulerFactory();
			log.debug("Initilizing Quartz Scheduller");
			sf.initialize("quartz.properties");
			Scheduler scheduler = sf.getScheduler();

			// and start it off
			scheduler.start();
			log.debug("Scheduller is starting.....");
			// define the job and tie it to our HelloJob class
			JobDetail job = newJob(JobDaemon.class).withIdentity("job1",
					"group1").build();

			// Trigger the job to run now, and then repeat every 40 seconds
			Trigger trigger = newTrigger()
					.withIdentity("trigger1", "group1")
					.startNow()
					.withSchedule(
							simpleSchedule().withIntervalInSeconds(60)
									.repeatForever()).build();

			// Tell quartz to schedule the job using our trigger
			scheduler.scheduleJob(job, trigger);

		} catch (SchedulerException se) {
			se.printStackTrace();
		}
	}
}
