function numDiff2Time(count) { 
	
	var year = 0;
	var month = 0;
	var day = 0;
	var hour = 0;
	var minu = 0;
	var second = 0;

	var year_0 = 3600 * 24 * 30 * 12;
	var month_0 = 3600 * 24 * 30;
	var day_0 = 3600 * 24;
	var hour_0 = 3600;
	var minu_0 = 60;
	
	
	if (count >= year_0) {
		year = Math.floor(count / (3600 * 24 * 30 * 12));
		count = count % (3600 * 24 * 30 * 12);
	}

	
	if (count >= month) {
		month = Math.floor(count / (3600 * 24 * 30));
		count = count % (3600 * 24 * 30);
	}

	
	if (count >= day_0) {
		day = Math.floor(count / (3600 * 24));
		count = count % (3600 * 24);
	}

	
	if (count >= hour_0) {
		hour = Math.floor(count / 3600);
		count = count % 3600;
	}

	
	if (count >= minu_0) {
		minu = Math.floor(count / 60);
		count = count % 60;
	}
	
	second = count;

	
	hour = (hour < 10) ? '0' + hour: hour;
	minu = (minu < 10) ? '0' + minu: minu;
	second = (second < 10) ? '0' + second: second;

	
	if (year !== 0) return year + "-" + month + "-" + day + " " + hour + ":" + minu + ":" + second;

	if (month !== 0) return month + "-" + day + " " + hour + ":" + minu + ":" + second;

	if (day !== 0) return day + " " + hour + ":" + minu + ":" + second;

	if (hour !== 0 && hour !== "00") return hour + ":" + minu + ":" + second;

	if (minu !== 0) return minu + ":" + second;

	if (second !== 0) return minu + ":" + second;
} 

function Main() { 

	this.stime;
	this.etime;
	this.t;
	this.tagNmae;
	this.totalTime =0 ;
	this.c = 0;

	
	var self=this;

	self.count = function() {

		
		self.c++;

		
		self.totalTime = numDiff2Time(self.c);

		
		$("#action p span:nth-child(2)").text(self.totalTime);

	}

} 

function stamp2time(timestamp){

	return new Date(parseInt(timestamp) * 1000).toLocaleString();

}


