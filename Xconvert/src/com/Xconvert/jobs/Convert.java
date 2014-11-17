package com.Xconvert.jobs;

import java.io.IOException;
import java.util.Scanner;
import java.util.regex.Pattern;

import org.apache.log4j.Logger;

import com.Xconvert.Main;


public class Convert{
	static Logger log = Logger.getLogger(
			 Main.class.getName());
	
	protected int jobId;
	protected String vsource;
	protected String vdestination;
	
	ProcessBuilder pb;
	Process p =null;
	
	public Convert(int id, String src, String dest){
		this.vsource = src;
		this.vdestination = dest;
		this.jobId = id;
		
	}
	
	public Boolean startConvert(){
		 this.pb = new ProcessBuilder("ffmpeg",
				                         "-i",
				           this.getVsource(),
				           "-c:v",
				           "libx264",
				           "-s",
				           "320x240",
				           "-c:a",
				           "libmp3lame",
				           "-b:a",
				           "160k",
				           this.getVdestination(),
				           "-y");
		 
		 try {
			 this.p = this.pb.start();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		 
		// TODO Auto-generated method stub
		  Scanner sc = new Scanner(this.p.getErrorStream());
		  
		   // Find duration
          Pattern durPattern = Pattern.compile("(?<=Duration: )[^,]*");
          String dur = sc.findWithinHorizon(durPattern, 0);
          if (dur == null)
            throw new RuntimeException("Could not parse duration.");
          String[] hms = dur.split(":");
          double totalSecs = Integer.parseInt(hms[0]) * 3600
                           + Integer.parseInt(hms[1]) *   60
                           + Double.parseDouble(hms[2]);
          log.debug("Total duration: " + totalSecs + " seconds.");

          // Find time as long as possible.
          Pattern timePattern = Pattern.compile("(?<=time=)[\\d:.]*");
          String match;
          String[] matchSplit;
          while (null != (match = sc.findWithinHorizon(timePattern, 0))) {
              matchSplit = match.split(":");
              double progress = Integer.parseInt(matchSplit[0]) * 3600 +
                  Integer.parseInt(matchSplit[1]) * 60 +
                  Double.parseDouble(matchSplit[2]);
              progress = progress / totalSecs;
              log.debug(Math.round(progress * 100)+" % Completed");
          }
          
       return true;   
	}
	
	
	public void createThumbnail(){
		//ffmpeg -i video_2.mp4  -ss 00:00:14.435 -f image2 -vframes 1  -s 160x120  video_2xxx.png
		 this.pb = new ProcessBuilder("ffmpeg",
				                      "-i",
				                      this.getVsource(),
				                      "-ss",
				                      "00:00:14.435",
				                      "-f",
				                      "image2",
				                      "-vframes",
				                      "1",
				                      "-s",
				                      "160x120",
				                      this.getVdestination()+".png",
				                      "-y");
		 
		 try {
			 this.p = this.pb.start();
			 
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}
	
	
	
	public String getVsource() {
		return vsource;
	}


	public void setVsource(String vsource) {
		this.vsource = vsource;
	}


	public String getVdestination() {
		return vdestination;
	}


	public void setVdestination(String vdestination) {
		this.vdestination = vdestination;
	}
	
	public int getJobId() {
		return this.jobId;
	}


	public void setJobId(int id) {
		this.jobId = id;
	}

}
