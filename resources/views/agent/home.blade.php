@extends('agent.layouts.app')

@push('css')
<style>
    .dashboard-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .dashboard-card.properties {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .dashboard-card.sales {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .dashboard-card.earnings {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .dashboard-card.performance {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    
    .card-icon {
        font-size: 3rem;
        color: rgba(255,255,255,0.8);
        margin-bottom: 1rem;
    }
    
    .card-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }
    
    .card-label {
        font-size: 1rem;
        color: rgba(255,255,255,0.9);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .card-trend {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255,255,255,0.2);
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 0.8rem;
        color: white;
    }
    
    .chart-card {
        background: white;
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .chart-card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }
    
    .chart-header {
        padding: 25px 25px 0;
        border-bottom: 1px solid #f0f0f0;
        margin-bottom: 20px;
    }
    
    .chart-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0;
    }
    
    .welcome-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>') repeat;
        animation: float 20s linear infinite;
    }
    
    @keyframes float {
        0% { transform: translateX(-100px) translateY(-100px); }
        100% { transform: translateX(100px) translateY(100px); }
    }
    
    .welcome-content {
        position: relative;
        z-index: 1;
    }
    
    .quick-actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }
    
    .quick-action-btn {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .quick-action-btn:hover {
        background: rgba(255,255,255,0.3);
        color: white;
        transform: translateY(-2px);
    }
    
    .stats-row {
        margin-top: 30px;
    }
    
    .chart-container {
        padding: 25px;
        min-height: 400px;
    }
    
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        padding: 30px;
        text-align: center;
        position: relative;
        color: white;
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .trend-up {
        color: #27ae60;
    }
    
    .trend-down {
        color: #e74c3c;
    }
</style>
@endpush

@section('content')
<!-- Welcome Section -->
<div class="welcome-section">
    <div class="welcome-content">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-3">Welcome back, {{Auth::user()->name}}!</h1>
                <p class="mb-0">Here's what's happening with your properties today. You have new opportunities waiting.</p>
                <div class="quick-actions">
                    <a href="#" class="quick-action-btn">
                        <i class="fas fa-plus me-2"></i>Add Property
                    </a>
                    <a href="#" class="quick-action-btn">
                        <i class="fas fa-chart-line me-2"></i>View Reports
                    </a>
                    <a href="#" class="quick-action-btn">
                        <i class="fas fa-users me-2"></i>Manage Clients
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <i class="fas fa-home" style="font-size: 5rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="dashboard-grid">
    <div class="dashboard-card properties stat-card">
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up me-1"></i>12%
        </div>
        <div class="card-icon">
            <i class="fas fa-building"></i>
        </div>
        <div class="card-value pulse">24</div>
        <div class="card-label">Total Properties</div>
    </div>
    
    <div class="dashboard-card sales stat-card">
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up me-1"></i>8%
        </div>
        <div class="card-icon">
            <i class="fas fa-handshake"></i>
        </div>
        <div class="card-value pulse">7</div>
        <div class="card-label">Sales This Month</div>
    </div>
    
    <div class="dashboard-card earnings stat-card">
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up me-1"></i>15%
        </div>
        <div class="card-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-value pulse">$18,450</div>
        <div class="card-label">Total Earnings</div>
    </div>
    
    <div class="dashboard-card performance stat-card">
        <div class="card-trend trend-up">
            <i class="fas fa-arrow-up me-1"></i>5%
        </div>
        <div class="card-icon">
            <i class="fas fa-star"></i>
        </div>
        <div class="card-value pulse">94%</div>
        <div class="card-label">Performance Score</div>
    </div>
</div>

<!-- Charts Section -->
<div class="row">
    <div class="col-xl-8 mb-30">
        <div class="chart-card">
            <div class="chart-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="chart-title">
                        <i class="fas fa-chart-area me-2 text-primary"></i>
                        Sales Activity Overview
                    </h3>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary btn-sm">7D</button>
                        <button type="button" class="btn btn-primary btn-sm">30D</button>
                        <button type="button" class="btn btn-outline-primary btn-sm">90D</button>
                    </div>
                </div>
                <p class="text-muted mt-2 mb-0">Track your property sales and client interactions</p>
            </div>
            <div class="chart-container">
                <div id="chart5" style="min-height: 350px;"></div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 mb-30">
        <!-- Lead Target Card -->
        <div class="chart-card mb-4">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-target me-2 text-success"></i>
                    Lead Target
                </h3>
                <p class="text-muted mt-2 mb-0">Monthly goal progress</p>
            </div>
            <div class="chart-container">
                <div id="chart6" style="min-height: 200px;"></div>
                <div class="text-center mt-3">
                    <span class="badge bg-success-light text-success px-3 py-2">
                        <i class="fas fa-arrow-up me-1"></i>
                        78% of target achieved
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity Card -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-clock me-2 text-warning"></i>
                    Recent Activity
                </h3>
            </div>
            <div class="px-4 pb-4">
                <div class="activity-item d-flex align-items-center mb-3">
                    <div class="activity-icon bg-primary-light text-primary rounded-circle p-2 me-3">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-medium">New property added</p>
                        <small class="text-muted">2 hours ago</small>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-center mb-3">
                    <div class="activity-icon bg-success-light text-success rounded-circle p-2 me-3">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-medium">Deal closed</p>
                        <small class="text-muted">5 hours ago</small>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-center">
                    <div class="activity-icon bg-info-light text-info rounded-circle p-2 me-3">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-medium">New client inquiry</p>
                        <small class="text-muted">1 day ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Add chart initialization scripts here
    document.addEventListener('DOMContentLoaded', function() {
        // You can add ApexCharts or Chart.js initialization here
        console.log('Dashboard loaded successfully');
        
        // Add some interactive effects
        const cards = document.querySelectorAll('.dashboard-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    });
</script>
@endpush