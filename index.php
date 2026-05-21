<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VentureConnect - Startup Investment Platform</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#0f172a;
    color:white;
}

.navbar{
    height:70px;
    padding:0 60px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    background:#020617;
    border-bottom:1px solid #1e293b;
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#facc15;
}

.logo span{
    color:#38bdf8;
}

.nav-links a{
    color:white;
    text-decoration:none;
    margin-left:25px;
    font-weight:bold;
}

.nav-links .btn{
    background:#facc15;
    color:#020617;
    padding:10px 18px;
    border-radius:8px;
}

.hero{
    min-height:88vh;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:40px;
    background:
        radial-gradient(circle at top, rgba(250,204,21,0.18), transparent 35%),
        linear-gradient(135deg,#020617,#0f172a);
}

.hero-content{
    max-width:850px;
}

.badge{
    display:inline-block;
    background:rgba(250,204,21,0.12);
    border:1px solid rgba(250,204,21,0.35);
    color:#facc15;
    padding:8px 18px;
    border-radius:30px;
    font-size:14px;
    margin-bottom:25px;
    font-weight:bold;
}

.hero h1{
    font-size:58px;
    line-height:1.1;
    margin-bottom:20px;
}

.hero h1 span{
    color:#facc15;
}

.hero p{
    color:#94a3b8;
    font-size:18px;
    line-height:1.7;
    margin-bottom:35px;
}

.hero-buttons a{
    text-decoration:none;
    padding:14px 24px;
    border-radius:10px;
    font-weight:bold;
    margin:8px;
    display:inline-block;
}

.primary{
    background:#facc15;
    color:#020617;
}

.secondary{
    border:1px solid #38bdf8;
    color:#38bdf8;
}

.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    padding:40px 60px;
    background:#020617;
}

.stat-box{
    text-align:center;
    padding:25px;
    background:#111827;
    border:1px solid #1e293b;
    border-radius:14px;
}

.stat-box h2{
    color:#facc15;
    font-size:32px;
}

.stat-box p{
    color:#94a3b8;
    margin-top:8px;
}

.section{
    padding:60px;
}

.section h2{
    font-size:36px;
    margin-bottom:30px;
    text-align:center;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:25px;
}

.card{
    background:#111827;
    border:1px solid #1e293b;
    padding:30px;
    border-radius:16px;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-6px);
    border-color:#facc15;
}

.card h3{
    color:#facc15;
    margin-bottom:15px;
    font-size:22px;
}

.card p{
    color:#94a3b8;
    line-height:1.6;
}

.footer{
    text-align:center;
    padding:25px;
    background:#020617;
    color:#94a3b8;
    border-top:1px solid #1e293b;
}

@media(max-width:768px){
    .navbar{
        padding:0 20px;
    }

    .hero h1{
        font-size:38px;
    }

    .section{
        padding:35px 20px;
    }

    .stats{
        padding:30px 20px;
    }
}
</style>
</head>

<body>

<div class="navbar">
    <div class="logo">Venture<span>Connect</span></div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php" class="btn">Get Started</a>
    </div>
</div>

<div class="hero">
    <div class="hero-content">
        <div class="badge">Startup Investment Management Platform</div>

        <h1>Where <span>Founders</span> Meet Visionary Investors</h1>

        <p>
            VentureConnect helps startups manage funding rounds, investors, valuations,
            and investment records through a simple role-based platform for founders,
            investors, and admin users.
        </p>

        <div class="hero-buttons">
            <a href="login.php" class="primary">Login Now</a>
            <a href="register.php" class="secondary">Create Account</a>
        </div>
    </div>
</div>

<div class="stats">
    <div class="stat-box">
        <h2>8+</h2>
        <p>Startups Listed</p>
    </div>

    <div class="stat-box">
        <h2>6+</h2>
        <p>Active Investors</p>
    </div>

    <div class="stat-box">
        <h2>₹49L+</h2>
        <p>Total Funding</p>
    </div>

    <div class="stat-box">
        <h2>10+</h2>
        <p>Investment Records</p>
    </div>
</div>

<div class="section">
    <h2>How VentureConnect Works</h2>

    <div class="cards">
        <div class="card">
            <h3>🚀 Founder Dashboard</h3>
            <p>
                Founders can view their startup details, funding rounds,
                investor records, valuation, and received investments.
            </p>
        </div>

        <div class="card">
            <h3>💼 Investor Dashboard</h3>
            <p>
                Investors can browse startups, view funding details,
                invest in startups, and track their investment history.
            </p>
        </div>

        <div class="card">
            <h3>🛡️ Admin Panel</h3>
            <p>
                Admin can manage all startups, founders, investors,
                investment records, and platform analytics.
            </p>
        </div>
    </div>
</div>

<div class="section">
    <h2>Platform Features</h2>

    <div class="cards">

        <div class="card">
            <h3>📊 Funding Management</h3>
            <p>
                Manage startup valuations, funding rounds,
                investment records, and equity distribution.
            </p>
        </div>

        <div class="card">
            <h3>🔐 Secure Role Access</h3>
            <p>
                Separate dashboards for Founder, Investor,
                and Admin users with role-based access control.
            </p>
        </div>

        <div class="card">
            <h3>📈 Investment Tracking</h3>
            <p>
                Track investor activities, startup growth,
                total funding, and investment analytics.
            </p>
        </div>

    </div>
</div>

<div class="footer">
    © 2026 VentureConnect | Developed by Vrushank Ramani
</div>

</body>
</html>