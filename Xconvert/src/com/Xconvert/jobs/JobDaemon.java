package com.Xconvert.jobs;

import java.io.File;
import java.util.List;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.apache.log4j.Logger;

import com.Xconvert.Main;
import com.Xconvert.models.EncodingJobs;
import com.Xconvert.server.JobsDAO;

public class JobDaemon implements Job {
	static Logger log = Logger.getLogger(Main.class.getName());
	JobsDAO jd;
	Convert converter;
	@Override
	public void execute(JobExecutionContext jec) throws JobExecutionException {
		jd = new JobsDAO();
		// TODO Auto-generated method stub
		log.info("JobDaemon executed.." + jec.getFireInstanceId());

		log.info("Getting the latest 3 pending jobs ...");

		List<EncodingJobs> jobs = jd.getLatestPendingJobs(3);

		if (jobs.size() > 0) {
			log.info("Found " + jobs.size() + " pending job(s)");
		} else {
			log.info("No pending job ...");
		}

		for (EncodingJobs job : jobs) {
			jd.UpdatePendingJob(job.getJob_id(), "proccessing");
			converter = new Convert(job.getJob_id(), job.getVideo_id(),
					job.getSource(), job.getDestination(), job.getThumbnail1());
			log.info("Convertion started...");
			Boolean convertRes = converter.startConvert();

			if (convertRes) {
				log.info("Convertion Finished.");
				log.info("Creating thumbnail....");
				String thumbnailPath = converter.createThumbnail();
				log.info("Creating thumbnail....Done." + thumbnailPath);
				jd.UpdatePendingJob(job.getJob_id(), "completed");
				log.info("deleteting original file");

				File f = new File(job.getSource());
				if (f.exists() && !f.isDirectory()) {
					f.delete();
					log.info("deleteting original file. Done");
				}
			}
		}

	}

}
